@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white">
        Resultado da busca por placa: <span class="text-orange-500">{{ $placa }}</span>
    </h2>

    @if ($veiculos->isEmpty())
        <p class="text-gray-700 dark:text-gray-300">Nenhum veículo encontrado.</p>
    @else
        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
            <table class="table-auto w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
                        <th class="px-4 py-2 border-b">Placa</th>
                        <th class="px-4 py-2 border-b">Modelo</th>
                        <th class="px-4 py-2 border-b">Marca</th>
                        <th class="px-4 py-2 border-b">Ano</th>
                        <th class="px-4 py-2 border-b">Cliente</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($veiculos as $veiculo)
                        <tr class="text-gray-700 dark:text-gray-300 border-b dark:border-gray-600">
                            <td class="px-4 py-2">{{ $veiculo->placa }}</td>
                            <td class="px-4 py-2">{{ $veiculo->modelo }}</td>
                            <td class="px-4 py-2">{{ $veiculo->marca }}</td>
                            <td class="px-4 py-2">{{ $veiculo->ano }}</td>
                            <td class="px-4 py-2">{{ $veiculo->cliente->nome ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection