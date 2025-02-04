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
        // Implementação do pagamento (ainda a definir)
    }

}
