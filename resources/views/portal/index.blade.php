@extends('layouts.app')

@section('title', 'Bem-vindo à Oficina')

@section('content')
    <div class="container mt-5">
        <!-- Seção de Boas-Vindas com Imagem de Fundo -->
        <div class="text-center mb-5 position-relative" style="
            background-image: url('{{ asset('images/oficina-carro.jpg') }}'); 
            background-size: cover; 
            background-position: center; 
            color: white; 
            padding: 150px 30px; 
            position: relative;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5);"></div>
            <h1 class="text-light position-relative">Bem-vindo à Nossa Oficina</h1>
            <p class="text-light position-relative">Seu parceiro confiável em manutenção e reparos automotivos.</p>
            <a href="{{ route('veiculos.create') }}" class="btn btn-success position-relative">Agendar Serviço</a>
        </div>

        <!-- Nossos Serviços -->
        <div class="mt-4">
            <h2 class="text-primary">Nossos Serviços</h2>
            <p class="text-secondary">Confira nossos serviços de qualidade para seu veículo.</p>
            <ul class="list-group">
                @foreach ($servicos as $servico)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $servico->nome }}
                        <span class="badge badge-primary badge-pill">{{ number_format($servico->preco, 2, ',', '.') }} Kz</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Diferenciais -->
        <div class="mt-5">
            <h2 class="text-primary">Por que escolher nossa oficina?</h2>
            <ul class="list-group">
                <li class="list-group-item">✅ Profissionais qualificados e experientes</li>
                <li class="list-group-item">✅ Peças originais e garantia nos serviços</li>
                <li class="list-group-item">✅ Atendimento rápido e eficiente</li>
                <li class="list-group-item">✅ Parceiros confiáveis no setor automotivo</li>
            </ul>
        </div>

        <!-- Parceiros -->
        <div class="mt-5">
            <h2 class="text-primary">Nossos Parceiros</h2>
            <p class="text-secondary">Trabalhamos com as melhores seguradoras e fornecedores de peças.</p>
        </div>

        <!-- Localização -->
        <div class="mt-5">
            <h2 class="text-primary">Onde Estamos</h2>
            <p class="text-secondary">Rua 4 de Abril, Bairro Centro, Cidade do Lubango - País</p>
            <iframe src="https://maps.google.com/maps?q=Lubango&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="300" style="border:0;" allowfullscreen=""></iframe>
        </div>

        <!-- Depoimentos de Clientes -->
        <div class="mt-5">
            <h2 class="text-primary">O que nossos clientes dizem</h2>
            <div class="card p-3">
                <p class="text-secondary">"Serviço excelente! Meu carro ficou como novo." - João M.</p>
                <p class="text-secondary">"Atendimento rápido e preço justo. Recomendo!" - Maria S.</p>
            </div>
        </div>

        <!-- Perguntas Frequentes -->
        <div class="mt-5">
            <h2 class="text-primary">Perguntas Frequentes</h2>
            <details>
                <summary>Quais serviços vocês oferecem?</summary>
                <p>Realizamos manutenção, revisão, pintura e troca de peças.</p>
            </details>
            <details>
                <summary>Quanto tempo leva um reparo?</summary>
                <p>O tempo depende do tipo de serviço, mas garantimos rapidez e qualidade.</p>
            </details>
        </div>

        <!-- Área Administrativa -->
        <div class="mt-5 text-center">
            <h2 class="text-primary">Área Administrativa</h2>
            <a href="{{ route('login') }}" class="btn btn-primary">Acessar o Sistema</a>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="bg-dark text-white text-center p-3 mt-5">
        <p>&copy; {{ date('Y') }} Oficina AutoFix. Todos os direitos reservados.</p>
    </footer>
@endsection
