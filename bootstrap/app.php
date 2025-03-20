<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\EnsureIsAdmin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            "isAdmin" => EnsureIsAdmin::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        /*$exceptions->render(function (Throwable $exceptions, Request $request) {
            if($request->is("api/*")){
                return response()->json([
                    "success" => false,
                    "error" => "Unauthorized"
                ], 401);
            }
        });*/
    })->create();
