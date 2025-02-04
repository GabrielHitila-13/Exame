@extends('layouts.app')

@section('title', 'Serviços da Oficina')

@section('content')
    <h1>Serviços Disponíveis</h1>
    <a href="{{ route('servicos.create') }}" class="btn" style="background-color:rgba(19, 34, 65, 0.71); color: white;">Adicionar Serviço</a>
    <a href="{{ route('register') }}" class="btn btn-primary">Criar Conta</a>


    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table>
        <tr>
            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Serviço</th>
            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Preço Base (Kz)</th>
            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Taxa de Parque (Kz)</th>
            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Seguro (Kz)</th>
            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Adicional (20%)</th>
            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Total a Pagar (Kz)</th>
            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Ações</th>
        </tr>
        @foreach ($servicos as $servico)
            @php
                $taxaParque = config('precos.taxa_parque');
                $seguroParque = config('precos.seguro_parque');
                $percentualServico = config('precos.percentual_servico');

                $adicional = $servico->preco * $percentualServico;
                $totalPagar = $servico->preco + $taxaParque + $seguroParque + $adicional;
            @endphp
            <tr>
                <td>{{ $servico->nome }}</td>
                <td>{{ number_format($servico->preco, 2, ',', '.') }}</td>
                <td>{{ number_format($taxaParque, 2, ',', '.') }}</td>
                <td>{{ number_format($seguroParque, 2, ',', '.') }}</td>
                <td>{{ number_format($adicional, 2, ',', '.') }}</td>
                <td><strong>{{ number_format($totalPagar, 2, ',', '.') }}</strong></td>
                <td>
                    <a href="{{ route('servicos.edit', $servico) }}" class="btn">Editar</a>
                    <form action="{{ route('servicos.destroy', $servico) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection  
