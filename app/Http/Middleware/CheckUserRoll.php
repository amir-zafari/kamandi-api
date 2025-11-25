<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRoll
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$rolls)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        if (!in_array($user->roll, $rolls)) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        return $next($request);
    }

}
