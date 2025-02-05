@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Minhas Viaturas</h2>

    @if ($veiculos->isEmpty())
        <p>Você não tem nenhuma viatura registrada.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Cor</th>
                    <th>Estado</th>
                    <th>Tipo de Avaria</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($veiculos as $veiculo)
                    <tr>
                        <td>{{ $veiculo->marca }}</td>
                        <td>{{ $veiculo->modelo }}</td>
                        <td>{{ $veiculo->cor }}</td>
                        <td><strong>{{ $veiculo->estado }}</strong></td>
                        <td>{{ $veiculo->tipo_avaria }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
