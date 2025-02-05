@extends('layouts.app')

@section('title', 'Cancelar Conta')

@section('content')
<div class="container">
    <h2 class="mb-4">Tem certeza de que deseja cancelar sua conta?</h2>
    <p class="mb-4">Esta ação é irreversível e removerá todos os seus dados.</p>

    <form action="{{ route('cliente.cancelarConta.post') }}" method="POST">
        @csrf
        @method('DELETE')

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-danger">Confirmar Cancelamento</button>
            <a href="{{ route('cliente.dashboard') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>
@endsection
