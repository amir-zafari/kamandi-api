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
     * Login user
     * @unauthenticated
     * @group Authentication
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
     * @unauthenticated
     * @group Authentication
     */
    public function sendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => ['required', 'regex:/^09[0-9]{9}$/'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $code = rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(5);
        $user = User::firstOrCreate(
            ['mobile' => $request->mobile],
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
     * Verify OTP
     * @unauthenticated
     * @group Authentication
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

        if (!$user || $user->otp != $request->code) {
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
     * Logout current device
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
     * Logout from all devices
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
