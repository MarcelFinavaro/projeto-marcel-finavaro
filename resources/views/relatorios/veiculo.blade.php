@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 max-w-3xl">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-white">📄 Relatório do Veículo</h2>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow space-y-4">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Dados do Veículo</h3>
        <p class="text-gray-700 dark:text-gray-300">Placa: <strong>{{ $veiculo->placa }}</strong></p>
        <p class="text-gray-700 dark:text-gray-300">Modelo: {{ $veiculo->modelo }}</p>
        <p class="text-gray-700 dark:text-gray-300">Marca: {{ $veiculo->marca }}</p>
        <p class="text-gray-700 dark:text-gray-300">Ano: {{ $veiculo->ano }}</p>

        <h3 class="text-lg font-bold text-gray-800 dark:text-white mt-6">Cliente</h3>
        <p class="text-gray-700 dark:text-gray-300">Nome: {{ $veiculo->cliente->nome ?? '—' }}</p>
        <p class="text-gray-700 dark:text-gray-300">Telefone: {{ $veiculo->cliente->telefone ?? '—' }}</p>
        <p class="text-gray-700 dark:text-gray-300">Email: {{ $veiculo->cliente->email ?? '—' }}</p>

        @if ($veiculo->ordens && $veiculo->ordens->count())
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mt-6">Ordens de Serviço</h3>
            <ul class="list-disc pl-5 text-gray-700 dark:text-gray-300">
                @foreach ($veiculo->ordens as $ordem)
                    <li>{{ $ordem->descricao }} — {{ \Carbon\Carbon::parse($ordem->data)->format('d/m/Y') }} ({{ $ordem->status }})</li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-700 dark:text-gray-300 mt-4">Nenhuma ordem de serviço registrada para este veículo.</p>
        @endif
    </div>
</div>
@endsection