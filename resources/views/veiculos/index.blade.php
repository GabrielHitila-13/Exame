@extends('layouts.app')

@section('title', 'Lista de Veículos')

@section('content')
    <div class="container mt-4">
        <h1>Lista de Veículos</h1>
        <a href="{{ route('veiculos.create') }}" class="btn" style="background-color:rgba(19, 34, 65, 0.71); color: white;">Adicionar Veículo</a>

        <table class="table table-striped table-bordered mt-3">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Cor</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($veiculos as $veiculo)
                    <tr>
                        <td>{{ $veiculo->marca }}</td>
                        <td>{{ $veiculo->modelo }}</td>
                        <td>{{ $veiculo->cor }}</td>
                        <td>{{ $veiculo->tipo }}</td>
                        <td>{{ $veiculo->estado }}</td>
                        <td>
                            <a href="{{ route('veiculos.show', $veiculo) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('veiculos.edit', $veiculo) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('veiculos.destroy', $veiculo) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
