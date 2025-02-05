@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Área do Cliente</h1>
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ route('veiculos.consultar') }}" class="btn btn-primary btn-block">Consultar Estado da Viatura</a>
        </div>
    </div>
</div>
@endsection
