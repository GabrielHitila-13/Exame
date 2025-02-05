@extends('layouts.app')

@section('title', 'Editar Serviço')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h2 class="text-center">Editar Serviço</h2>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('servicos.update', $servico) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Campo Nome -->
                <div class="mb-3">
                    <label for="nome" class="form-label fw-bold">Nome:</label>
                    <input id="nome" type="text" name="nome" 
                           class="form-control @error('nome') is-invalid @enderror" 
                           value="{{ old('nome', $servico->nome) }}" required>
                    @error('nome')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <!-- Campo Preço -->
                <div class="mb-3">
                    <label for="preco" class="form-label fw-bold">Preço (Kz):</label>
                    <input id="preco" type="number" name="preco" 
                           class="form-control @error('preco') is-invalid @enderror" 
                           value="{{ old('preco', $servico->preco) }}" required step="0.01">
                    @error('preco')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <!-- Botões -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Atualizar</button>
                    <a href="{{ route('servicos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
