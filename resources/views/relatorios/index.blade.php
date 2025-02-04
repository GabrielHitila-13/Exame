@extends('layouts.app')

@section('content')
<h1>Relatórios</h1>

<ul>
    <li><a href="{{ route('relatorios.numero_viaturas') }}">Número de Viaturas</a></li>
    <h1>Total de Viaturas</h1>
    <p>O número total de viaturas registradas é: <strong>{{ $total }}</strong></p>

    <li><a href="{{ route('relatorios.viaturas_concluidas') }}">Viaturas Concluídas</a></li>
    <h1>Total de Viaturas concluidas</h1>
    <p>O número total de viaturas concluidas é: <strong>{{ $total }}</strong></p>


    <li><a href="{{ route('relatorios.viaturas_pendentes') }}">Viaturas Pendentes</a></li>
    <h1>Total de Viaturas Pendentes</h1>
    <p>O número total de viaturas pendenetes é: <strong>{{ $total }}</strong></p>
</ul>
@endsection
