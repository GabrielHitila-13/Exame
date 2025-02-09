@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Área do Cliente</h1>
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ route('consultar.index') }}" class="btn btn-primary btn-block">Consultar Estado da Viatura</a>
        </div>
        <form action="{{ route('users.destroy', Auth::user()->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');">
            @csrf
         @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir Minha Conta</button>
</form>

    </div>
</div>
@endsection
