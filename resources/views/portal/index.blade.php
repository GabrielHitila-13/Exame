@extends('layouts.app')

@section('title', 'Bem-vindo à Oficina')

@section('content')
    <h1>Bem-vindo à Oficina</h1>
    <p>Oferecemos serviços de manutenção e reparo para seu veículo.</p>

    <h2>Nossos Serviços</h2>
    <ul>
        @foreach ($servicos as $servico)
            <li>{{ $servico->nome }} - {{ number_format($servico->preco, 2, ',', '.') }} Kz</li>
        @endforeach
    </ul>

    <h2>Parceiros</h2>
    <p>Temos parceria com diversas seguradoras e fabricantes de peças.</p>

    <h2>Localização</h2>
    <p>Rua Principal, Bairro Centro, Cidade - País</p>

    <h2>Área Administrativa</h2>
    <a href="{{ route('login') }}" class="btn btn-primary">Acessar o Sistema</a>
@endsection
