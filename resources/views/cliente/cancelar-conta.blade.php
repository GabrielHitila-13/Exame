@extends('layouts.app')

@section('title', 'Cancelar Conta')

@section('content')
    <h2>Tem certeza de que deseja cancelar sua conta?</h2>
    <p>Esta ação é irreversível e removerá todos os seus dados.</p>

    <form action="{{ route('cliente.cancelarConta.post') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Confirmar Cancelamento</button>
        <a href="{{ route('cliente.dashboard') }}" class="btn btn-secondary">Voltar</a>
    </form>
@endsection
