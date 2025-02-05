@extends('layouts.app')
@section('title', 'Relatórios')
@section('content')
    <div class="container mt-4">
        <h1>Relatórios</h1>
        <p>Relatórios de veículos</p>
    
    </div>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Estado</th>
                <th>Data de Criação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($veiculos as $veiculo)
                <tr>
                    <td>{{ $veiculo->marca }}</td>
                    <td>{{ $veiculo->modelo }}</td>
                    <td>{{ $veiculo->estado }}</td>
                    <td>{{ $veiculo->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
