<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsBuyer
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isBuyer()) {
            if ($request->user()?->isSeller()) {
                return redirect()->route('seller.dashboard');
            }

            return redirect()->route('login');
        }

        return $next($request);
    }
}
