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
        $middleware->redirectGuestsTo(function(Request $request){
            if($request->is('admin/*')){
                return route('admin.showLogin');
            }
        });
        $middleware->redirectUsersTo(function(Request $request){
            if($request->is('admin/*')){
                return route('admin.dashboard');
            }
        });
        $middleware->redirectUsersTo(function(Request $request){
            if($request->is('user/*')){
                return route('user.dashboard');
            }
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
