<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use Illuminate\Support\Facades\Auth;

class TecnicoController extends Controller
{
    public function index()
    {
        // Obter os veículos atribuídos ao técnico logado
        $veiculos = Veiculo::where('user_id', Auth::id())->get();
        
        return view('tecnico.index', compact('veiculos'));
    }

    public function atualizarEstado(Request $request, Veiculo $veiculo)
    {
        // Garantir que apenas o técnico responsável pode alterar o estado
        if ($veiculo->user_id !== Auth::id()) {
            return redirect()->route('tecnico.viaturas')->with('error', 'Você não tem permissão para alterar o estado desta viatura.');
        }

        $request->validate([
            'estado' => 'required|in:Em análise,Aguardando peças,Em reparo,Concluído',
        ]);

        $veiculo->update(['estado' => $request->estado]);

        return redirect()->route('tecnico.viaturas')->with('success', 'Estado atualizado com sucesso.');
    }

    public function adicionarObservacao(Request $request, Veiculo $veiculo)
    {
        if ($veiculo->user_id !== Auth::id()) {
            return redirect()->route('tecnico.viaturas')->with('error', 'Você não tem permissão para adicionar observação nesta viatura.');
        }

        $request->validate([
            'observacao' => 'required|string',
        ]);

        $veiculo->update([
            'observacao' => $request->observacao,
        ]);

        return redirect()->route('tecnico.viaturas')->with('success', 'Observação adicionada com sucesso.');
    }
}
