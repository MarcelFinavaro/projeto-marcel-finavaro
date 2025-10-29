@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-white">🚗 Lista de Veículos</h1>

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
        <p class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded-full shadow">
            {{ session('success') }}
        </p>
    @endif

    {{-- Botão de novo veículo --}}
    <a href="{{ route('veiculos.create') }}"
       class="inline-block mb-6 px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition">
       ➕ Cadastrar Novo Veículo
    </a>

    {{-- Tabela de veículos --}}
    @if ($veiculos->count())
        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
            <table class="table-auto w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
                        <th class="px-4 py-2 border-b">Placa</th>
                        <th class="px-4 py-2 border-b">Modelo</th>
                        <th class="px-4 py-2 border-b">Marca</th>
                        <th class="px-4 py-2 border-b">Ano</th>
                        <th class="px-4 py-2 border-b">Cliente</th>
                        <th class="px-4 py-2 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($veiculos as $veiculo)
                        <tr class="text-gray-700 dark:text-gray-300 border-b dark:border-gray-600">
                            <td class="px-4 py-2">{{ $veiculo->placa }}</td>
                            <td class="px-4 py-2">{{ $veiculo->modelo }}</td>
                            <td class="px-4 py-2">{{ $veiculo->marca }}</td>
                            <td class="px-4 py-2">{{ $veiculo->ano }}</td>
                            <td class="px-4 py-2">{{ $veiculo->cliente->nome ?? '—' }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('veiculos.edit', $veiculo->placa) }}"
                                   class="px-3 py-1 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                                   ✏️ Editar
                                </a>
                                <form action="{{ route('veiculos.destroy', $veiculo->placa) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition"
                                        onclick="return confirm('Tem certeza que deseja excluir?')">
                                        🗑️ Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-700 dark:text-gray-300 mt-4">Nenhum veículo cadastrado.</p>
    @endif
</div>
@endsection