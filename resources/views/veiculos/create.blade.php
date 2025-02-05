@extends('layouts.app')

@section('title', 'Cadastrar Veículo')

@section('content')
    <div class="container mt-4">
        <h1>Cadastrar Veículo</h1>
        <form action="{{ route('veiculos.store') }}" method="POST">
            @csrf

            <!-- Campo Marca -->
            <div class="row mb-3">
                <label for="marca" class="col-md-4 col-form-label text-md-end">Marca:</label>
                <div class="col-md-6">
                    <input id="marca" type="text" class="form-control @error('marca') is-invalid @enderror" name="marca" value="{{ old('marca') }}" required>

                    @error('marca')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Campo Modelo -->
            <div class="row mb-3">
                <label for="modelo" class="col-md-4 col-form-label text-md-end">Modelo:</label>
                <div class="col-md-6">
                    <input id="modelo" type="text" class="form-control @error('modelo') is-invalid @enderror" name="modelo" value="{{ old('modelo') }}" required>

                    @error('modelo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Campo Cor -->
            <div class="row mb-3">
                <label for="cor" class="col-md-4 col-form-label text-md-end">Cor:</label>
                <div class="col-md-6">
                    <input id="cor" type="text" class="form-control @error('cor') is-invalid @enderror" name="cor" value="{{ old('cor') }}" required>

                    @error('cor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Campo Tipo -->
            <div class="row mb-3">
                <label for="tipo" class="col-md-4 col-form-label text-md-end">Tipo:</label>
                <div class="col-md-6">
                    <input id="tipo" type="text" class="form-control @error('tipo') is-invalid @enderror" name="tipo" value="{{ old('tipo') }}" required>

                    @error('tipo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Campo Estado -->
            <div class="row mb-3">
                <label for="estado" class="col-md-4 col-form-label text-md-end">Estado:</label>
                <div class="col-md-6">
                    <input id="estado" type="text" class="form-control @error('estado') is-invalid @enderror" name="estado" value="{{ old('estado') }}" required>

                    @error('estado')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Campo Tipo de Avaria -->
            <div class="row mb-3">
                <label for="tipo_avaria" class="col-md-4 col-form-label text-md-end">Tipo de Avaria:</label>
                <div class="col-md-6">
                    <input id="tipo_avaria" type="text" class="form-control @error('tipo_avaria') is-invalid @enderror" name="tipo_avaria" value="{{ old('tipo_avaria') }}" required>

                    @error('tipo_avaria')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Botões -->
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a class="btn btn-secondary" href="{{ route('veiculos.index') }}">Voltar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
