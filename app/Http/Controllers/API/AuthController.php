<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Login user | ورود کاربر
     * 
     * Authenticate a user with email/mobile and password, along with captcha verification.
     * احراز هویت کاربر با ایمیل/موبایل و کلمه عبور به همراه تأیید کپچا.
     * 
     * @unauthenticated
     * @group Authentication
     * 
     * @bodyParam mobile string required Email or mobile number for authentication. Example: 09123456789
     * @bodyParam password string required User's password. Example: password123
     * @bodyParam captcha_id string required Captcha ID received from captcha generation. Example: uuid-string
     * @bodyParam answer string required Captcha answer. Example: ABC12
     * 
     * @response 200 {
     *   "access_token": "1|token_string_here",
     *   "token_type": "Bearer",
     *   "user": {
     *     "id": 1,
     *     "first_name": "احمد",
     *     "last_name": "محمدی",
     *     "roll": "patient",
     *     "mobile": "09123456789"
     *   }
     * }
     * 
     * @response 400 {
     *   "status": "error",
     *   "message": "Captcha expired | کپچا منقضی شده است"
     * }
     * 
     * @response 401 {
     *   "message": "Invalid login credentials | اطلاعات ورود نامعتبر است"
     * }
     * 
     * @response 422 {
     *   "message": "Invalid identifier format | قالب شناسه نامعتبر است"
     * }
     */
    public function login(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string', // ایمیل یا شماره موبایل
            'password' => 'required|string',
            'captcha_id' => 'required|string',
            'answer' => 'required|string',
        ]);

        $key = "captcha:" . $request->captcha_id;
        $storedCaptcha = Cache::get($key);

        if (!$storedCaptcha) {
            return response()->json([
                'status' => 'error',
                'message' => 'Captcha expired'
            ], 400);
        }
        if (strtoupper($request->answer) !== strtoupper($storedCaptcha)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid captcha'
            ], 400);
        }

        // حذف کپچا پس از تأیید
        Cache::forget($key);

        $identifier = $request->mobile;

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } elseif (preg_match('/^09[0-9]{9}$/', $identifier)) {
            $field = 'mobile';
        } else {
            return response()->json(['message' => 'Invalid identifier format'], 422);
        }

        $user = User::where($field, $identifier)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'roll' => $user->roll,
                'mobile' => $user->mobile,
            ],
        ]);
    }

    /**
     * Send verification code
     * 
     * Send an OTP verification code to user's mobile number for authentication.
     * This endpoint is rate-limited to a maximum of 3 requests per 30 minutes per mobile number
     * to protect the SMS provider.
     * 
     * @unauthenticated
     * @group Authentication
     * 
     * @bodyParam mobile string required Iranian mobile number (09xxxxxxxxx format). Example: 09123456789
     * 
     * @response 200 {
     *   "message": "کد تأیید ارسال شد",
     *   "otp": 123456
     * }
     * 
     * @response 422 {
     *   "mobile": ["The mobile field is required."]
     * }
     * 
     * @response 429 {
     *   "status": "error",
     *   "message": "تعداد درخواست زیاد است. لطفاً بعداً تلاش کنید (حداکثر ۳ بار در ۳۰ دقیقه)."
     * }
     */
    public function sendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => ['required', 'regex:/^09[0-9]{9}$/'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Rate limit: max 3 sends per 30 minutes per mobile
        $mobile = $request->mobile;
        $key = 'otp_attempts:' . $mobile;
        $now = Carbon::now();
        $windowStart = $now->clone()->subMinutes(30);

        $attempts = Cache::get($key, []);
        // Keep only attempts within the last 30 minutes
        $attempts = array_values(array_filter($attempts, function ($ts) use ($windowStart) {
            try {
                return Carbon::parse($ts)->greaterThanOrEqualTo($windowStart);
            } catch (\Exception $e) {
                return false;
            }
        }));

        if (count($attempts) >= 3) {
            return response()->json([
                'status' => 'error',
                'message' => 'تعداد درخواست زیاد است. لطفاً بعداً تلاش کنید (حداکثر ۳ بار در ۳۰ دقیقه).'
            ], 429);
        }

        // Generate and store new attempt
        $attempts[] = $now->toIso8601String();
        // Save with TTL of 30 minutes from now (safe because we filter old ones each time)
        Cache::put($key, $attempts, now()->addMinutes(30));

        $code = rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(5);
        $user = User::firstOrCreate(
            ['mobile' => $mobile],
            [
                'first_name' => "کاربر",
                'last_name' => '',
            ]
        );
        $user->update([
            'code' => $code,
            'code_expires_at' => $expiresAt,
        ]);
        return response()->json([
            'message' => 'کد تأیید ارسال شد',
            'otp' => $code,
        ]);
    }
    /**
     * Verify OTP | تایید کد تأیید
     * 
     * Verify the OTP code sent to user's mobile number and return authentication token.
     * 
     * @unauthenticated
     * @group Authentication
     * 
     * @bodyParam mobile string required Iranian mobile number (09xxxxxxxxx format). Example: 09123456789
     * @bodyParam otp string required 6-digit OTP code. Example: 123456
     * 
     * @response 200 {
     *   "access_token": "1|token_string_here",
     *   "token_type": "Bearer",
     *   "user": {
     *     "id": 1,
     *     "first_name": "احمد",
     *     "last_name": "محمدی",
     *     "roll": "patient"
     *   }
     * }
     * 
     * @response 400 {
     *   "message": "Invalid verification code"
     * }
     * 
     * @response 400 {
     *   "message": "Verification code has expired"
     * }
     * 
     * @response 422 {
     *   "mobile": ["The mobile field is required."],
     *   "otp": ["The otp must be 6 digits."]
     * }
     */
    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => ['required', 'regex:/^09[0-9]{9}$/'],
            'otp' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('mobile', $request->mobile)->first();

        if (!$user || $user->code != $request->otp) {
            return response()->json(['message' => 'Invalid verification code'], 400);
        }

        if (Carbon::now()->greaterThan($user->code_expires_at)) {
            return response()->json(['message' => 'Verification code has expired'], 400);
        }

        $user->update([
            'code' => null,
            'code_expires_at' => null,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'roll' => $user->roll,
            ],
        ]);
    }
    /**
     * Logout current device | خروج از دستگاه فعلی
     * @authenticated
     * @group Authentication (Protected)
     */
    public function logout(Request $request)
    {
        // حذف توکن فعلی
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully.'
        ], 200);
    }
    /**
     * Logout from all devices | خروج از همه دستگاه‌ها
     * @authenticated
     * @group Authentication (Protected)
     */
    public function logoutAll(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out from all devices.'
        ], 200);
    }

}
