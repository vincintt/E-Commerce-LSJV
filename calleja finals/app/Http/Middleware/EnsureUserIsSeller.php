<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsSeller
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect()->route('seller.login');
        }
        if (! $request->user()->isSeller()) {
            return redirect()->route('home')->with('error', 'That area is for seller accounts only.');
        }

        return $next($request);
    }
}
