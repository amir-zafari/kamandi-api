<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class TokenController extends Controller
{
    /**
     * ایجاد submit token پس از حل کپچای تصویری
     */
    public function create(Request $request)
    {
        $request->validate([
            'captcha_id' => 'required|string',
            'captcha_answer' => 'required|string',
        ]);

        $key = "captcha:" . $request->captcha_id;
        $storedCaptcha = Cache::get($key);

        if (!$storedCaptcha) {
            return response()->json([
                'status' => 'error',
                'message' => 'Captcha expired'
            ], 400);
        }

        if (strtoupper($request->captcha_answer) !== strtoupper($storedCaptcha)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid captcha'
            ], 400);
        }

        // حذف کپچا پس از تأیید
        Cache::forget($key);

        // تولید submit token تصادفی
        $token = Str::random(40);
        $tokenKey = "submit_token:$token";

        Cache::put($tokenKey, json_encode([
            'ip' => $request->ip(),
            'created_at' => now()->toDateTimeString(),
        ]), now()->addMinutes(5)); // TTL 5 دقیقه

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'expires_in' => 300
        ]);
    }
}
