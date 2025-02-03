@extends('layouts.app')

@section('title', 'Lista de Veículos')

@section('content')
    <h1>Lista de Veículos</h1>
    <a href="{{ route('veiculos.create') }}" class="btn" style="background-color:rgba(19, 34, 65, 0.71); color: white;">Adicionar Veículo</a>

    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Marca</th>
            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Modelo</th>
            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Cor</th>
            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Ações</th>
        </tr>
        @foreach ($veiculos as $veiculo)
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $veiculo->marca }}</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $veiculo->modelo }}</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $veiculo->cor }}</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">
                    <a href="{{ route('veiculos.show', $veiculo) }}" class="btn">Ver</a>
                    <a href="{{ route('veiculos.edit', $veiculo) }}" class="btn">Editar</a>
                    <form action="{{ route('veiculos.destroy', $veiculo) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
