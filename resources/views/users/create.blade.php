@extends('layouts.app')

@section('title', 'Adicionar Usuário')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h2 class="text-center">Adicionar Usuário</h2>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Campo Nome -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nome:</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                           name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <!-- Campo Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email:</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <!-- Campo Senha -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Senha:</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                           name="password" required>
                    @error('password')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <!-- Campo Nível de Acesso -->
                <div class="mb-3">
                    <label for="role" class="form-label fw-bold">Nível de Acesso:</label>
                    <select id="role" name="role" class="form-select @error('role') is-invalid @enderror">
                        <option value="admin">Administrador</option>
                        <option value="secretario">Secretário</option>
                        <option value="tecnico">Técnico</option>
                        <option value="cliente">Cliente</option>
                    </select>
                    @error('role')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <!-- Campo de Upload de Documento -->
                <div class="mb-3">
                    <label for="documento_identificacao" class="form-label fw-bold">Documento de Identificação:</label>
                    <input id="documento_identificacao" type="file" 
                           class="form-control @error('documento_identificacao') is-invalid @enderror" 
                           name="documento_identificacao" required>
                    @error('documento_identificacao')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <!-- Botões -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a class="btn btn-outline-secondary" href="{{ route('users.index') }}">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
