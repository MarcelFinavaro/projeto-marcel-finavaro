@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-white">🧾 Ordens de Serviço</h1>

    @if (session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded-full shadow">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('ordens.create') }}"
       class="inline-block mb-6 px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition">
       ➕ Nova Ordem
    </a>

    @if ($ordens->count())
        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
            <table class="table-auto w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
                        <th class="px-4 py-2 border-b">ID</th>
                        <th class="px-4 py-2 border-b">Cliente</th>
                        <th class="px-4 py-2 border-b">Veículo</th>
                        <th class="px-4 py-2 border-b">Data</th>
                        <th class="px-4 py-2 border-b">Status</th>
                        <th class="px-4 py-2 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordens as $ordem)
                        <tr class="text-gray-700 dark:text-gray-300 border-b dark:border-gray-600">
                            <td class="px-4 py-2">{{ $ordem->id }}</td>
                            <td class="px-4 py-2">{{ $ordem->cliente->nome ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $ordem->veiculo->modelo ?? '—' }} ({{ $ordem->veiculo->placa ?? '' }})</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($ordem->data)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2 capitalize">{{ $ordem->status }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('ordens.edit', $ordem->id) }}"
                                   class="px-3 py-1 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                                   ✏️ Editar
                                </a>
                                <form action="{{ route('ordens.destroy', $ordem->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition"
                                        onclick="return confirm('Tem certeza que deseja excluir esta ordem?')">
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
        <p class="text-gray-700 dark:text-gray-300 mt-4">Nenhuma ordem de serviço cadastrada.</p>
    @endif
</div>
@endsection