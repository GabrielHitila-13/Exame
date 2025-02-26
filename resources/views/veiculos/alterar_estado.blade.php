@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Alterar Estado da Viatura</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('veiculos.alterar_estado', $veiculo->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="codigo_validacao" class="form-label">Código de Validação</label>
            <input type="text" class="form-control" name="codigo_validacao" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Sua Senha</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="mb-3">
            <label for="novo_estado" class="form-label">Novo Estado</label>
            <select class="form-select" name="novo_estado" required>
                <option value="Em análise">Em análise</option>
                <option value="Aguardando peças">Aguardando peças</option>
                <option value="Em reparação">Em reparação</option>
                <option value="Concluído">Concluído</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Confirmar Alteração</button>
    </form>

    @if ($veiculo->estado !== 'Concluído')
        <form action="{{ route('veiculos.concluir', $veiculo->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Concluir Veículo</button>
        </form>
    @else
        <p>O veículo já foi concluído.</p>
    @endif
</div>
@endsection
