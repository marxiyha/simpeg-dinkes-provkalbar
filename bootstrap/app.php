<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))

    /*
    |--------------------------------------------------------------------------
    | ROUTING
    |--------------------------------------------------------------------------
    */
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    /*
    |--------------------------------------------------------------------------
    | MIDDLEWARE
    |--------------------------------------------------------------------------
    */
    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        // Alias middleware custom kamu
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);

        // (OPSIONAL) kalau nanti mau tambah middleware global
        // $middleware->append(\App\Http\Middleware\SomeMiddleware::class);

    })

    /*
    |--------------------------------------------------------------------------
    | EXCEPTIONS
    |--------------------------------------------------------------------------
    */
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    ->create();