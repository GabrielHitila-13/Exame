@extends('layouts.app')

@section('content')
    <h1>Detalhes do Veículo</h1>
    <p><strong>Marca:</strong> {{ $veiculo->marca }}</p>
    <p><strong>Modelo:</strong> {{ $veiculo->modelo }}</p>
    <p><strong>Cor:</strong> {{ $veiculo->cor }}</p>
    <p><strong>Tipo:</strong> {{ $veiculo->tipo }}</p>
    <p><strong>Estado:</strong> {{ $veiculo->estado }}</p>
    <p><strong>Tipo de Avaria:</strong> {{ $veiculo->tipo_avaria }}</p>
    <p><strong>Código de Validação:</strong> {{ $veiculo->codigo_validacao }}</p>
    <a href="{{ route('veiculos.index') }}">Voltar</a>
@endsection
