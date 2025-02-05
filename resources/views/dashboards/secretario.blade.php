@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Painel do Secretário</h2>
    <p>Aqui você pode gerenciar viaturas, registrar taxas e gerar relatórios.</p>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-3 mb-3">
            <a href="{{ route('veiculos.index') }}" class="btn btn-primary btn-block">Gerenciar Veículos</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('servicos.index') }}" class="btn btn-primary btn-block">Taxas de Pagamento</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('relatorio.index') }}" class="btn btn-warning btn-block">Relatórios</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('veiculos.consultar') }}" class="btn btn-warning btn-block">Consultar Veículos</a>
        </div>
    </div>

</div>
@endsection
