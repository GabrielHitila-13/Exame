@extends('layouts.app')

<form action="{{ route('tecnico.alterarEstado', $veiculo->id) }}" method="POST">
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
            <!-- opções do estado -->
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Alterar Estado</button>
</form>
