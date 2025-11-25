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
        $middleware->alias([
            'check.submit.token' => \App\Http\Middleware\CheckSubmitToken::class,
            'check.roll' => \App\Http\Middleware\CheckUserRoll::class,
        ]);
        // برای API نیازی به redirect نیست
        // $middleware->redirectGuestsTo('/login'); // حذف شد
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // تغییر ترتیب پارامترها از (Request, Exception) به (Exception, Request) برای رفع خطای TypeError
        $exceptions->render(function (Throwable $exception, $request) {
            // مدیریت کاربران غیرمجاز (Unauthenticated)
            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            // سایر Exception ها را به صورت JSON برگردان
            // تلاش برای گرفتن status code یا fallback به 500
            $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;

            // در صورتی که Exception اصلی کد وضعیت نداشته باشد و یک خطای 404 یا 405 باشد، آن را مشخص می‌کنیم
            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException || $exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
                $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 404;
            }

            return response()->json([
                'message' => $exception->getMessage(),
                'type' => config('app.debug') ? get_class($exception) : null, // نوع خطا را فقط در Debug Mode نمایش دهید
                'trace' => config('app.debug') ? $exception->getTrace() : null,
            ], $statusCode);
        });
    })
    ->create();
