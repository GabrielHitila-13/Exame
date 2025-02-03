@extends('layouts.app')

@section('title', 'Cadastrar Veículo')

@section('content')
    <h1>Cadastrar Veículo</h1>
    <form action="{{ route('veiculos.store') }}" method="POST">
        @csrf
        <label>Marca:</label>
        <input type="text" name="marca" required>

        <label>Modelo:</label>
        <input type="text" name="modelo" required>

        <label>Cor:</label>
        <input type="text" name="cor" required>

        <label>Tipo:</label>
        <input type="text" name="tipo" required>

        <label>Estado:</label>
        <input type="text" name="estado" required>

        <label>Tipo de Avaria:</label>
        <input type="text" name="tipo_avaria" required>

        <button type="submit">Salvar</button>
    </form>
@endsection
