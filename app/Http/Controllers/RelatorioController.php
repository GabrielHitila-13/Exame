<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RelatorioController extends Controller
{
    public function index()
    {
        // Contagem geral
        $totalVeiculos = Veiculo::count();
        $veiculosConcluidos = Veiculo::where('estado', 'Concluído')->count();
        $veiculosPendentes = Veiculo::where('estado', '!=', 'Concluído')->count();
        
        // Obter todos os veículos
        $veiculos = Veiculo::all();

        // Passando todas as variáveis para a view
        return view('relatorios.index', compact('totalVeiculos', 'veiculosConcluidos', 'veiculosPendentes', 'veiculos'));
    }

    public function gerarRelatorio()
    {
        $veiculos = Veiculo::all();
        return view('relatorios.index', compact('veiculos'));
    }
}
