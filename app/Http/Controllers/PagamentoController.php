<?php

namespace App\Http\Controllers;

use App\Models\c;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(c $c)
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'veiculo_id' => 'required|exists:veiculos,id',
            'valor' => 'required|numeric',
        ]);

        Pagamento::create($request->all());

        return redirect()->back()->with('success', 'Taxa de pagamento registrada com sucesso!');
    }

/**
     * Permite que o cliente solicite um orçamento.
     */
    public function solicitarOrcamento(Request $request)
    {
        // Implementação do orçamento (ainda a definir)
    }

/**
     * Permite que o cliente efetue pagamento por referência bancária.
     */
    public function efetuarPagamento(Request $request)
{
    $request->validate([
        'veiculo_id' => 'required|exists:veiculos,id',
        'servico_id' => 'required|exists:servicos,id',
    ]);

    $veiculo = Veiculo::findOrFail($request->veiculo_id);
    $servico = Servico::findOrFail($request->servico_id);

    // Obtendo os valores fixos do sistema
    $taxaParque = config('precos.taxa_parque');
    $seguroParque = config('precos.seguro_parque');
    $percentualServico = config('precos.percentual_servico');

    // Calculando o valor total a pagar
    $valorTotal = $servico->preco + $taxaParque + $seguroParque + ($servico->preco * $percentualServico);

    // Criar um novo pagamento no banco
    Pagamento::create([
        'veiculo_id' => $veiculo->id,
        'servico_id' => $servico->id,
        'valor' => $valorTotal,
        'status' => 'pendente', // Pode ser 'pendente', 'pago', 'cancelado'
    ]);

    return redirect()->back()->with('success', 'Pagamento registrado com sucesso. Valor total: ' . number_format($valorTotal, 2) . ' MT');
}

}
