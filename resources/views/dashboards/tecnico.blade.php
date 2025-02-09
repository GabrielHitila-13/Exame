@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Painel do Técnico</h1>
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ route('tecnico.viaturas') }}" class="btn btn-primary btn-block">Minhas Viaturas</a>
        </div>
       
    </div>
</div>
@endsection
