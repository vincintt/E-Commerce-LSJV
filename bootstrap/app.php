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
        $middleware->redirectGuestsTo(function (Request $request) {
            return str_starts_with($request->path(), 'seller')
                ? route('seller.login')
                : route('login');
        });
        $middleware->redirectUsersTo(function (Request $request) {
            return $request->user()?->isSeller()
                ? route('seller.reports.index')
                : route('home');
        });
        $middleware->alias([
            'buyer' => \App\Http\Middleware\EnsureUserIsBuyer::class,
            'seller' => \App\Http\Middleware\EnsureUserIsSeller::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
