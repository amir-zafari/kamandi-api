<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // برای API نیازی به redirect نیست
        // $middleware->redirectGuestsTo('/login'); // حذف شد
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function ($request, $exception) {
            // مدیریت کاربران غیرمجاز
            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            // سایر Exception ها را به صورت JSON برگردان
            return response()->json([
                'message' => $exception->getMessage(),
                'type' => get_class($exception),
                'trace' => config('app.debug') ? $exception->getTrace() : null,
            ], method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500);
        });
    })
    ->create();
