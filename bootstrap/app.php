<?php

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
        // Middleware untuk admin
        $middleware->redirectGuestsTo(function(Request $request){
            if ($request->is('admin/*')) {
                return route('admin.showLogin');
            }
        });

        $middleware->redirectUsersTo(function(Request $request){
            if ($request->is('admin/*') && auth('admin')->check()) {
                return redirect()->route('admin.dashboard');
            }
        });

        // Middleware untuk user
        $middleware->redirectGuestsTo(function(Request $request){
            if ($request->is('user/*')) {
                return route('user.showLogin');
            }
        });

        $middleware->redirectUsersTo(function(Request $request){
            if ($request->is('user/*') && auth('user')->check()) {
                return redirect()->route('user.dashboard');
            }
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
