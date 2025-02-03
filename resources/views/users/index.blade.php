@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
    <h1>Lista de Usuários</h1>
    <a href="{{ route('users.create') }}" class="btn">Adicionar Usuário</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Nível de Acesso</th>
            <th>Ações</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>
                    <form action="{{ route('users.destroy', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
