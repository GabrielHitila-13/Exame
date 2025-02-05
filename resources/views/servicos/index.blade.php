@extends('layouts.app')

@section('title', 'Serviços da Oficina')

@section('content')
    <div class="container">
        <h1 class="mb-4">Serviços Disponíveis</h1>

        <div class="mb-3">
            <a href="{{ route('servicos.create') }}" class="btn btn-dark">Adicionar Serviço</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Criar Conta</a>
        </div>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Serviços</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Agendamentos</a></li>
                    <li><a class="dropdown-item" href="#">Histórico</a></li>
                </ul>
        </li>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Serviço</th>
                        <th>Preço Base (Kz)</th>
                        <th>Taxa de Parque (Kz)</th>
                        <th>Seguro (Kz)</th>
                        <th>Adicional (20%)</th>
                        <th>Total a Pagar (Kz)</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
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
                                <a href="{{ route('servicos.edit', $servico) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('servicos.destroy', $servico) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este serviço?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
