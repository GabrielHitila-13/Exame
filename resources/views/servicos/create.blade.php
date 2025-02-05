@extends('layouts.app')

@section('title', 'Adicionar Serviço')

@section('content')
    <div class="container">
        <h1>Adicionar Serviço</h1>
        <form action="{{ route('servicos.store') }}" method="POST">
            @csrf

            <!-- Campo Nome -->
            <div class="row mb-3">
                <label for="nome" class="col-md-4 col-form-label text-md-end">Nome:</label>
                <div class="col-md-6">
                    <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}" required>

                    @error('nome')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Campo Preço -->
            <div class="row mb-3">
                <label for="preco" class="col-md-4 col-form-label text-md-end">Preço (Kz):</label>
                <div class="col-md-6">
                    <input id="preco" type="number" class="form-control @error('preco') is-invalid @enderror" name="preco" value="{{ old('preco') }}" required step="0.01">

                    @error('preco')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Botões -->
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a class="btn btn-secondary" href="{{ route('servicos.index') }}">Voltar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
