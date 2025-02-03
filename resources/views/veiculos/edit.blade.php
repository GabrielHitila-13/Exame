@extends('layouts.app')

@section('title', 'Editar Veículo')

@section('content')
    <h1>Editar Veículo</h1>
    <form action="{{ route('veiculos.update', $veiculo) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label>Marca:</label>
        <input type="text" name="marca" value="{{ $veiculo->marca }}" required>

        <label>Modelo:</label>
        <input type="text" name="modelo" value="{{ $veiculo->modelo }}" required>

        <label>Cor:</label>
        <input type="text" name="cor" value="{{ $veiculo->cor }}" required>

        <label>Tipo:</label>
        <input type="text" name="tipo" value="{{ $veiculo->tipo }}" required>

        <label>Estado:</label>
        <input type="text" name="estado" value="{{ $veiculo->estado }}" required>

        <label>Tipo de Avaria:</label>
        <input type="text" name="tipo_avaria" value="{{ $veiculo->tipo_avaria }}" required>

        <button type="submit">Atualizar</button>
    </form>
@endsection
