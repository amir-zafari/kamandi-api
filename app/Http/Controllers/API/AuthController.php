<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
//    // ثبت‌نام کاربر
//    public function register(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|unique:users,email',
//            'password' => 'required|string|min:6|confirmed',
//            'national_id' => 'nullable|string|unique:users,national_id',
//            'phone' => ['required', 'regex:/^09[0-9]{9}$/', 'unique:users,phone',
//            ],
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json($validator->errors(), 422);
//        }
//
//        $user = User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//            'phone' => $request->phone,
//            'national_id' => $request->national_id ?? null
//        ]);
//
//        $token = $user->createToken('auth_token')->plainTextToken;
//
//        return response()->json([
//            'access_token' => $token,
//            'token_type' => 'Bearer',
//        ], 201);
//    }
//
//    // ورود کاربر
//    public function login(Request $request)
//    {
//        $request->validate([
//            'identifier' => 'required|string', // ایمیل یا شماره موبایل
//            'password' => 'required|string',
//        ]);
//
//        $identifier = $request->identifier;
//
//        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
//            $field = 'email';
//        } elseif (preg_match('/^09[0-9]{9}$/', $identifier)) {
//            $field = 'phone';
//        } else {
//            return response()->json(['message' => 'Invalid identifier format'], 422);
//        }
//
//        $user = User::where($field, $identifier)->first();
//
//        if (!$user || !Hash::check($request->password, $user->password)) {
//            return response()->json(['message' => 'Invalid login credentials'], 401);
//        }
//
//        $token = $user->createToken('auth_token')->plainTextToken;
//
//        return response()->json([
//            'access_token' => $token,
//            'token_type' => 'Bearer',
//            'user' => [
//                'id' => $user->id,
//                'name' => $user->name,
//                'email' => $user->email,
//                'phone' => $user->phone,
//            ],
//        ]);
//    }

    public function sendCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'regex:/^09[0-9]{9}$/'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $code = rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(5);
        $user = User::firstOrCreate(
            ['phone' => $request->phone],
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
            'code_for_test' => $code, // برای تست فقط
        ]);
    }
    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'regex:/^09[0-9]{9}$/'],
            'code' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('phone', $request->phone)->first();

        if (!$user || $user->code != $request->code) {
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
}
