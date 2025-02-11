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

    public function create()
{
    if (!in_array(auth()->user()->role, ['secretario', 'admin'])) {
        abort(403, 'Acesso negado');
    }

    $users = User::all();
    return view('veiculos.create', compact('users'));
}

}
