<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CheckSubmitToken
{
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header('Authorization');
        if (!$header || !preg_match('/^Bearer\s+(.+)$/', $header, $m)) {
            return response()->json(['status'=>'error','message'=>'Missing submit token'], 401);
        }
        $token = $m[1];
        $key = "submit_token:{$token}";
        $data = Cache::get($key);
        if (!$data) {
            return response()->json(['status'=>'error','message'=>'Invalid or expired submit token'], 403);
        }

        $info = json_decode($data, true);
        if (!is_array($info)) {
            return response()->json(['status'=>'error','message'=>'Invalid token data'], 500);
        }

        // optional: ip bind check
        $ip = $request->ip();
        if (isset($info['ip']) && $info['ip'] !== $ip) {
            return response()->json(['status'=>'error','message'=>'IP mismatch for token'], 403);
        }

        // pass token info to request so controller can update flags
        $request->attributes->set('submit_token_key', $key);
        $request->attributes->set('submit_token_info', $info);
        $request->attributes->set('submit_token_raw', $token);

        return $next($request);
    }
}
