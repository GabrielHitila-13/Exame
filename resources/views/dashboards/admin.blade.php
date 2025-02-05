@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Painel do Administrador</h2>
    <p>Bem-vindo, Admin! Aqui você pode gerenciar todo o sistema.</p>

    <div class="row">
        <div class="col-md-3 mb-3">
            <a href="{{ route('users.index') }}" class="btn btn-primary btn-block">Gerenciar Usuários</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('servicos.index') }}" class="btn btn-warning btn-block">Gerenciar Serviços</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('veiculos.index') }}" class="btn btn-primary btn-block">Gerenciar Veículos</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('relatorios.index') }}" class="btn btn-primary btn-block">Gerar Relatório de Veículos</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('cliente.cancelarConta') }}" class="btn btn-primary btn-block">Gerenciar Contas</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('veiculos.consultar') }}" class="btn btn-warning btn-block">Consultar Veículos</a>
        </div>
    </div>
</div>
@endsection
