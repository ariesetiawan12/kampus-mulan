<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        /*
        |--------------------------------------------------------------------------
        | Trusted Proxies
        |--------------------------------------------------------------------------
        |
        | Railway menggunakan reverse proxy untuk HTTPS.
        | Konfigurasi ini membuat Laravel mengenali request asli
        | sebagai HTTPS sehingga url(), route(), asset(), redirect(),
        | dan form action tidak lagi menghasilkan http://.
        |
        */

        $middleware->trustProxies(at: '*');

    })

    ->withExceptions(function (Exceptions $exceptions): void {

        /*
        |--------------------------------------------------------------------------
        | API JSON Exception
        |--------------------------------------------------------------------------
        |
        | Request ke /api/* akan mendapatkan response JSON ketika
        | terjadi exception.
        |
        */

        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );

    })
    ->create();