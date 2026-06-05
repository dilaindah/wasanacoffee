<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // 🌟 DI SINI KITA DAFTARKAN ALIAS SATPAM ADMIN ADEK UNTUK LARAVEL 12 🌟
        $middleware->alias([
            'admin.auth' => \App\Http\Middleware\EnsureAdminLoggedIn::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();