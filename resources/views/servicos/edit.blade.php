@extends('layouts.app')

@section('title', 'Editar Serviço')

@section('content')
    <h1>Editar Serviço</h1>
    <form action="{{ route('servicos.update', $servico) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nome:</label>
        <input type="text" name="nome" value="{{ $servico->nome }}" required>

        <label>Preço (Kz):</label>
        <input type="number" name="preco" value="{{ $servico->preco }}" required step="0.01">

        <button type="submit">Atualizar</button>
    </form>
@endsection
