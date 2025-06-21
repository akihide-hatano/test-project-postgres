<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\PreventClickjacking; // 追加

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // グローバルなWebミドルウェアとして追加
        // 既存のWebミドルウェアの末尾に追加されます。
        // ここに直接append()またはprepend()を使用します。
        $middleware->append(
            PreventClickjacking::class,
        );

        // もし特定のミドルウェアの前後に挿入したい場合は、以下のように記述できます
        // $middleware->validateCsrfTokens(except: [
        //     'stripe/*',
        //     'cashier/*',
        // ]);


        // エイリアスを定義する場合 (既存のまま)
        $middleware->alias([
            'admin' => RoleMiddleware::class,
            // 'preventClickjacking' => PreventClickjacking::class, // 必要ならエイリアスも追加
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();