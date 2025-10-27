@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Criar Ordem de Serviço</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erro!</strong> Corrija os campos abaixo:
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ordens.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" class="form-select" required>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="veiculo_id" class="form-label">Veículo</label>
            <select name="veiculo_id" class="form-select" required>
                @foreach ($veiculos as $veiculo)
                    <option value="{{ $veiculo->placa }}" {{ old('veiculo_id') == $veiculo->placa ? 'selected' : '' }}>
                        {{ $veiculo->placa }} - {{ $veiculo->modelo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" name="descricao" class="form-control" value="{{ old('descricao') }}" required>
        </div>

        <div class="mb-3">
            <label for="data_servico" class="form-label">Data</label>
            <input type="date" name="data_servico" class="form-control" value="{{ old('data_servico') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('ordens.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection