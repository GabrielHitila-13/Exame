<!-- resources/views/veiculos/tecnico.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Viaturas em Manutenção</h2>

        @if($veiculos->isEmpty())
            <p>Não há viaturas em manutenção no momento.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Estado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($veiculos as $veiculo)
                        <tr>
                            <td>{{ $veiculo->id }}</td>
                            <td>{{ $veiculo->marca }}</td>
                            <td>{{ $veiculo->modelo }}</td>
                            <td>{{ $veiculo->estado }}</td>
                            <td>
                                <a href="{{ route('veiculos.alterar_estado', $veiculo->id) }}" class="btn btn-warning">Alterar Estado</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
