@extends('layouts.app')

@section('title', 'Adicionar Serviço')

@section('content')
    <h1>Adicionar Serviço</h1>
    <form action="{{ route('servicos.store') }}" method="POST">
        @csrf
        <label>Nome:</label>
        <input type="text" name="nome" required>

        <label>Preço (Kz):</label>
        <input type="number" name="preco" required step="0.01">

        <button type="submit">Salvar</button>
        <button class="nav-item"><a class="nav-link" href="{{ route('servicos.index') }}">Voltar</a></button>
    </form>
@endsection
