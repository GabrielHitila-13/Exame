@extends('layouts.app')

@section('title', 'Bem-vindo à Oficina')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            <h1 class="text-primary">Bem-vindo à Oficina</h1>
            <p class="text-secondary">Oferecemos serviços de manutenção e reparo para seu veículo.</p>
        </div>

        <div class="mt-4">
            <h2 class="text-primary">Nossos Serviços</h2>
            <ul class="list-group">
                @foreach ($servicos as $servico)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $servico->nome }}
                        <span class="badge badge-primary badge-pill">{{ number_format($servico->preco, 2, ',', '.') }} Kz</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="mt-4">
            <h2 class="text-primary">Parceiros</h2>
            <p class="text-secondary">Temos parceria com diversas seguradoras e fabricantes de peças.</p>
        </div>

        <div class="mt-4">
            <h2 class="text-primary">Localização</h2>
            <p class="text-secondary">Rua 4 de Abril, Bairro Centro, Cidade do Lubango - País</p>
        </div>

        <div class="mt-4 text-center">
            <h2 class="text-primary">Área Administrativa</h2>
            <a href="{{ route('login') }}" class="btn btn-primary">Acessar o Sistema</a>
        </div>
    </div>
@endsection
