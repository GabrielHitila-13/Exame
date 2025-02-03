@extends('layouts.app')

@section('title', 'Serviços da Oficina')

@section('content')
    <h1>Serviços Disponíveis</h1>
    <a href="{{ route('servicos.create') }}" class="btn" style="background-color:rgba(19, 34, 65, 0.71); color: white;">Adicionar Serviço</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table>
        <tr>
            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Serviço</th>
            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Preço (Kz)</th>
            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Ações</th>
        </tr>
        @foreach ($servicos as $servico)
            <tr>
                <td>{{ $servico->nome }}</td>
                <td>{{ number_format($servico->preco, 2, ',', '.') }}</td>
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
