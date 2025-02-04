<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,secretario,tecnico,cliente',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }
    /**
     * Atualiza o nível de acesso do usuário (somente para administrador).
     */
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,secretario,tecnico,cliente',
        ]);

        $user->update(['role' => $request->role]);

        return redirect()->back()->with('success', 'Nível de acesso atualizado com sucesso!');
    }

    /**
     * Exibe o formulário de cancelamento de conta.
     */
    public function showCancelForm()
    {
        return view('cliente.cancelar-conta');
    }

    public function cancelarConta(Request $request)
    {
        $user = Auth::user();

        // Opcional: Salvar registro do cancelamento para auditoria
        \Log::info("Conta cancelada: " . $user->email);

        // Excluir o usuário
        $user->delete();

        // Logout e redirecionamento
        Auth::logout();

        return redirect('/')->with('success', 'Sua conta foi cancelada com sucesso.');
    }
    
}
