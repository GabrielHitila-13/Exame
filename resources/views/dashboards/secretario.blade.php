@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Painel do Secretário</h2>
    <p>Aqui você pode gerenciar viaturas, registrar taxas e gerar relatórios.</p>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('veiculos.index') }}" class="btn btn-primary btn-block">Gerenciar Veículos</a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('pagamentos.index') }}" class="btn btn-warning btn-block">Gerenciar Pagamentos</a>
        </div>
    </div>
</div>
@endsection
