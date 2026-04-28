<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            HandlePrecognitiveRequests::class,
        ]);

        $middleware->alias([
                    'locale' => \App\Http\Middleware\SetLocale::class,
                    'admin.locale' => \App\Http\Middleware\SetAdminLocale::class,
                ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
