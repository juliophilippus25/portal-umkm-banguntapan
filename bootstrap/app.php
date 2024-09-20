<?php

use App\Http\Middleware\UserRedirectIfAuthenticated;
use Illuminate\Http\Request;
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
        $middleware->alias([
            'RedirectIfAuthenticated' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'userRedirectIfNotAuthenticated' => \App\Http\Middleware\UserRedirectIfNotAuthenticated::class,
            'adminRedirectIfNotAuthenticated' => \App\Http\Middleware\AdminRedirectIfNotAuthenticated::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
