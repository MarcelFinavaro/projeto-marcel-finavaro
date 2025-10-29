@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes da Ordem de Serviço</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Descrição</h5>
            <p class="card-text">{{ $ordemServico->descricao }}</p>

            <h5 class="card-title">Data</h5>
            <p class="card-text">{{ \Carbon\Carbon::parse($ordemServico->data)->format('d/m/Y') }}</p>

            <h5 class="card-title">Veículo</h5>
            <p class="card-text">
                {{ $ordemServico->veiculo->placa }} - {{ $ordemServico->veiculo->modelo }} ({{ $ordemServico->veiculo->ano }})
            </p>
        </div>
    </div>

    <a href="{{ route('ordens-servico.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection