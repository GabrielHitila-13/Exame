<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClienteMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role === 'cliente') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Acesso negado!');
    }
}
