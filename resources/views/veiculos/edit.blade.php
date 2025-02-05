@extends('layouts.app')

@section('title', 'Editar Veículo')

@section('content')
    <div class="container mt-4">
        <h1>Editar Veículo</h1>
        <form action="{{ route('veiculos.update', $veiculo) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="marca" class="form-label">Marca:</label>
                <input type="text" name="marca" id="marca" class="form-control" value="{{ $veiculo->marca }}" required>
            </div>

            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo:</label>
                <input type="text" name="modelo" id="modelo" class="form-control" value="{{ $veiculo->modelo }}" required>
            </div>

            <div class="mb-3">
                <label for="cor" class="form-label">Cor:</label>
                <input type="text" name="cor" id="cor" class="form-control" value="{{ $veiculo->cor }}" required>
            </div>

            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo:</label>
                <input type="text" name="tipo" id="tipo" class="form-control" value="{{ $veiculo->tipo }}" required>
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select name="estado" id="estado" class="form-control">
                    <option value="Em andamento" @if($veiculo->estado == 'Em andamento') selected @endif>Em andamento</option>
                    <option value="Concluída" @if($veiculo->estado == 'Concluída') selected @endif>Concluída</option>
                    <!-- Adicione outras opções conforme necessário -->
                </select>
            </div>

            <div class="mb-3">
                <label for="tipo_avaria" class="form-label">Tipo de Avaria:</label>
                <input type="text" name="tipo_avaria" id="tipo_avaria" class="form-control" value="{{ $veiculo->tipo_avaria }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
@endsection
