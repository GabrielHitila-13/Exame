<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    protected function authenticated(Request $request, $user)
{
    if ($user->role == 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role == 'secretario') {
        return redirect()->route('secretario.dashboard');
    } elseif ($user->role == 'tecnico') {
        return redirect()->route('tecnico.dashboard');
    } elseif ($user->role == 'cliente') {
        return redirect()->route('cliente.dashboard');
    }
    return redirect('/home');
}

Public function username()
{
    return 'username';
}

public function login(Request $request)
{
    $credentials = $request->validate([
        'login' => 'required|string',
        'password' => 'required|string',
    ]);

    // Verifica se login é um e-mail ou username
    $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    if (Auth::attempt([$field => $credentials['login'], 'password' => $credentials['password']])) {
        return redirect()->intended('/home');
    }

    return back()->withErrors(['login' => 'Credenciais inválidas.']);
}
}
