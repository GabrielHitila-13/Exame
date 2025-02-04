@extends('layouts.app')

@section('title', 'Adicionar Usuário')

@section('content')
    <div class="container">
        <h1>Adicionar Usuário</h1>
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Campo Nome -->
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Nome:</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Campo Email -->
            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">Email:</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Campo Senha -->
            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">Senha:</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Campo Nível de Acesso -->
            <div class="row mb-3">
                <label for="role" class="col-md-4 col-form-label text-md-end">Nível de Acesso:</label>
                <div class="col-md-6">
                    <select id="role" name="role" class="form-control @error('role') is-invalid @enderror">
                        <option value="admin">Administrador</option>
                        <option value="secretario">Secretário</option>
                        <option value="tecnico">Técnico</option>
                        <option value="cliente">Cliente</option>
                    </select>

                    @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Campo de Upload de Documento -->
            <div class="row mb-3">
                <label for="documento_identificacao" class="col-md-4 col-form-label text-md-end">Documento de Identificação:</label>
                <div class="col-md-6">
                    <input id="documento_identificacao" type="file" class="form-control @error('documento_identificacao') is-invalid @enderror" name="documento_identificacao" required>

                    @error('documento_identificacao')
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
                    <a class="btn btn-secondary" href="{{ route('users.index') }}">Voltar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
