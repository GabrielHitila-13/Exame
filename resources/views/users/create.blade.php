@extends('layouts.app')

@section('title', 'Adicionar Usuário')

@section('content')
    <h1>Adicionar Usuário</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label>Nome:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Senha:</label>
        <input type="password" name="password" required>

        <label>Nível de Acesso:</label>
        <select name="role">
            <option value="admin">Administrador</option>
            <option value="secretario">Secretário</option>
            <option value="tecnico">Técnico</option>
            <option value="cliente">Cliente</option>
        </select>

        <button type="submit">Salvar</button>
        <button class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Voltar</a></button>
    </form>
@endsection
