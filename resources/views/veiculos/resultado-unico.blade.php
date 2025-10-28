@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-orange-500 mb-4">🔍 Resultado da Pesquisa por Placa</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-800 dark:text-gray-100">
            <div><strong>Placa:</strong> {{ $veiculo->placa }}</div>
            <div><strong>Modelo:</strong> {{ $veiculo->modelo }}</div>
            <div><strong>Marca:</strong> {{ $veiculo->marca }}</div>
            <div><strong>Ano:</strong> {{ $veiculo->ano }}</div>
            <div><strong>Cor:</strong> {{ $veiculo->cor }}</div>
            <div><strong>Cliente:</strong> {{ $veiculo->cliente_nome ?? 'Não vinculado' }}</div>
        </div>

        <div class="mt-6">
            <a href="{{ route('veiculos.index') }}"
               class="inline-block px-4 py-2 bg-orange-500 text-white rounded shadow hover:bg-orange-600 transition">
                ← Voltar para lista de veículos
            </a>
        </div>
    </div>
@endsection