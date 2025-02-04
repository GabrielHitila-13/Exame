<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecretarioMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role === 'secretario') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Acesso negado!');
    }
}
