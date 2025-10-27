@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Ordem de Serviço</h2>

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

    

  <form action="{{ route('ordens.update', ['ordem' => $ordem->id]) }}" method="POST">
   @csrf 
   @method('PUT')

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <input type="text" name="descricao" class="form-control" value="{{ old('descricao', $ordem->descricao) }}" required>
    </div>

    <div class="mb-3">
        <label for="data_servico" class="form-label">Data</label>
        <input type="date" name="data_servico" class="form-control" value="{{ old('data_servico', $ordem->data_servico) }}" required>
    </div>

    <div class="mb-3">
        <label for="veiculo_id" class="form-label">Veículo</label>
        <select name="veiculo_id" class="form-select" required>
            @foreach ($veiculos as $veiculo)
                <option value="{{ $veiculo->placa }}" {{ $veiculo->placa == $ordem->veiculo_id ? 'selected' : '' }}>
                    {{ $veiculo->placa }} - {{ $veiculo->modelo }}
                </option>
            @endforeach
        </select>
    </div>
     
    <div class="mb-3">
    <label for="cliente_id" class="form-label">Cliente</label>
    <select name="cliente_id" class="form-select" required>
        @foreach ($clientes as $cliente)
            <option value="{{ $cliente->id }}" {{ $cliente->id == $ordem->cliente_id ? 'selected' : '' }}>
                {{ $cliente->nome }}
            </option>
        @endforeach
     </select>
    </div>

    <button type="submit" class="btn btn-success">Atualizar</button>
    <a href="{{ route('ordens.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
</div>
@endsection