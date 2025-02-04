<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
        /**
     * Exibe todas as viaturas registradas (apenas para secretário e administrador).
     */
    public function index()
    {
        $veiculos = Veiculo::all();
        return view('veiculos.index', compact('veiculos'));
    }

    /**
     * Exibe o formulário de cadastro de uma nova viatura (somente para secretário).
     */
    public function create()
    {
        return view('veiculos.create');
    }


    /**
     * Armazena uma nova viatura no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'tipo_avaria' => 'required|string|max:255',
            'codigo_validacao' => 'required|unique:veiculos|string|max:10',
        ]);

        $veiculo = new Veiculo($request->all());
        $veiculo->codigo_validacao = strtoupper(uniqid());
        $veiculo->save();

        return redirect()->route('veiculos.index')->with('success', 'Veículo cadastrado com sucesso!');
    }

    /**
     * Exibe detalhes de uma viatura específica.
     */
    public function show(Veiculo $veiculo)
    {
        return view('veiculos.show', compact('veiculo'));
    }

    /**
     * Exibe formulário de edição de uma viatura (somente para secretário).
     */
    public function edit(Veiculo $veiculo)
    {
        return view('veiculos.edit', compact('veiculo'));
    }

    public function update(Request $request, Veiculo $veiculo)
    {
        $request->validate([
            'marca' => 'required',
            'modelo' => 'required',
            'cor' => 'required',
            'tipo' => 'required',
            'estado' => 'required',
            'tipo_avaria' => 'required',
        ]);

        $veiculo->update($request->all());

        return redirect()->route('veiculos.index')->with('success', 'Veículo atualizado com sucesso!');
    }

    public function destroy(Veiculo $veiculo)
    {
        $veiculo->delete();
        return redirect()->route('veiculos.index')->with('success', 'Veículo excluído com sucesso!');
    }

    public function veiculos()
{
    // Funcionalidade para o secretário registrar e ver viaturas
}

/**
     * Gera um relatório de todas as viaturas (somente para secretário e administrador).
     */
    public function relatorios()
    {
        $veiculos = Veiculo::all();
        return view('veiculos.relatorios', compact('veiculos'));
    }

/**
     * Exibe as viaturas atribuídas ao técnico.
     */
    public function tecnico()
    {
        $veiculos = Veiculo::where('estado', 'Em manutenção')->get();
        return view('veiculos.tecnico', compact('veiculos'));
    }


/**
     * Permite ao técnico alterar o estado da viatura após diagnóstico e solução.
     */
    public function alterarEstado(Request $request, Veiculo $veiculo)
    {
        //Validar entrada do usuário
        $request->validate([
        'estado' => 'required|string|max:255',
        'codigo_validacao' => 'required|string',
        'password' => 'required|string',
        'novo_estado' => 'required|string'
    ]);

    // Verificar se o código de validação é correto
    if ($veiculo->codigo_validacao !== $request->codigo_validacao) {
        return back()->with('error', 'Código de validação incorreto.');
    }

    // Verificar senha do usuário autenticado
    if (!Hash::check($request->password, auth()->user()->password)) {
        return back()->with('error', 'Senha incorreta.');
    }

    // Atualizar o estado da viatura
    $veiculo->estado = $request->novo_estado;
    $veiculo->save();

    return back()->with('success', 'Estado da viatura atualizado com sucesso.');
    
        $request->validate([
            'estado' => 'required|string|max:255',
        ]);

        $veiculo->update(['estado' => $request->estado]);

        return redirect()->route('veiculos.tecnico')->with('success', 'Estado da viatura atualizado com sucesso!');
    }

/**
     * Permite ao cliente consultar o estado da sua viatura.
     */
    public function consultarEstado()
{
    // Pega o usuário autenticado
    $user = auth()->user();

    // Obtém apenas os veículos do cliente autenticado
    $veiculos = Veiculo::where('user_id', $user->id)->get();

    return view('veiculos.consultar', compact('veiculos'));
}
}
