<?php

use Tymon\JWTAuth\Providers\LaravelServiceProvider;
use Tymon\JWTAuth\Http\Middleware\Authenticate as JWTAuthenticate;
use Tymon\JWTAuth\Http\Middleware\RefreshToken;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
         $middleware->alias([
            'jwt.auth'    => JWTAuthenticate::class,
            'jwt.refresh' => RefreshToken::class,
        ]);
    })
    ->withProviders([
        LaravelServiceProvider::class,
    ])
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
