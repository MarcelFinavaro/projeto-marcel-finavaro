@extends('layouts.app')

@section('content')
<h2>Editar Ordem de Serviço</h2>

<form action="{{ route('ordens.update', $ordem->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="cliente_cpf">Cliente:</label>
        <select name="cliente_cpf" required>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->cpf }}" {{ $ordem->cliente_cpf == $cliente->cpf ? 'selected' : '' }}>
                    {{ $cliente->nome }} ({{ $cliente->cpf }})
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="veiculo_placa">Veículo:</label>
        <select name="veiculo_placa" required>
            @foreach($veiculos as $veiculo)
                <option value="{{ $veiculo->placa }}" {{ $ordem->veiculo_placa == $veiculo->placa ? 'selected' : '' }}>
                    {{ $veiculo->modelo }} - {{ $veiculo->placa }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" required>{{ $ordem->descricao }}</textarea>
    </div>

    <div>
        <label for="data_servico">Data do Serviço:</label>
       <input type="date" name="data_servico" value="{{ \Carbon\Carbon::parse($ordem->data_servico)->format('Y-m-d') }}" required>
    </div>

    <button type="submit">Atualizar</button>
</form>
@endsection