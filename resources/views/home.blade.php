@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Sair</button>
</form>

                <div class="card-header">{{ __('Seja bem vindo : Dashboard') }}</div>
                <a href="{{ route('register') }}" class="btn btn-primary">Criar Conta</a>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Estas logado!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
