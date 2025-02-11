@extends('layouts.app')

@section('title', 'Editar user')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h2 class="text-center">Editar Usuario</h2>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Campo Nome -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nome:</label>
                    <input id="name" type="text" name="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{ old('name', $user->name) }}" required>
                    @error('name')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>


                <!-- Campo Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email:</label>
                    <input id="email" type="text" name="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email', $user->email) }}" required step="0.01">
                    @error('email')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password:</label>
                    <input id="password" type="text" name="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           value="{{ old('password', $user->password) }}" required step="0.01">
                    @error('password')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <!-- Campo Nivel Acesso-->
             <div class="mb-3">
                <label for="role" class="form-label fw-bold">Nível de Acesso:</label>
                 <select id="role" name="role" class="form-control @error('role') is-invalid @enderror" required>
                   <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="secretario" {{ old('role', $user->role) == 'secretario' ? 'selected' : '' }}>Secretário</option>
                    <option value="tecnico" {{ old('role', $user->role) == 'tecnico' ? 'selected' : '' }}>Técnico</option>
                    <option value="cliente" {{ old('role', $user->role) == 'cliente' ? 'selected' : '' }}>Cliente</option>
                 </select>
                     @error('role')
                  <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                      @enderror
             </div>
>

                <!-- Botões -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Atualizar</button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
