<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$guards)
{
    if (Auth::check()) {
        $user = Auth::user();

        switch ($user->role) {
            case 'admin':
                return redirect('/admin/dashboard');
            case 'secretario':
                return redirect('/secretario/dashboard');
            case 'tecnico':
                return redirect('/tecnico/dashboard');
            case 'cliente':
                return redirect('/meus-veiculos');
            default:
                return redirect('/home');
        }
    }

    return $next($request);
}

}
