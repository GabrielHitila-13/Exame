<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TecnicoMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role === 'tecnico') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Acesso negado!');
    }
}
