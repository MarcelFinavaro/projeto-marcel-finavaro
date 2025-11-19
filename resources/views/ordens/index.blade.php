@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white text-center">Ordens de Serviço</h2>
    @if (session('error'))
    <div class="mb-4 px-4 py-2 bg-red-100 text-red-800 rounded-full shadow">
        {{ session('error') }}
    </div>
    @endif

    <form method="GET" action="{{ route('ordens.buscar') }}" class="mb-6 flex justify-center">
    <input
        type="text"
        name="placa"
        placeholder="🔍 Buscar OS por placa"
        value="{{ request('placa') }}"
        class="px-4 py-2 border rounded-l-full focus:outline-none focus:ring focus:border-blue-300 dark:bg-gray-700 dark:text-white"
    >
    <button
        type="submit"
        class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-r-full shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition"
    >
        Buscar
    </button>
    </form>

    @if (session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded-full shadow">
            {{ session('success') }}
        </div>
    @endif

    <!--<a href="{{ route('ordens.create') }}"
       class="inline-block mb-4 px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition">
       ➕ Nova Ordem de Serviço
    </a> -->

    @if ($ordens->count())
        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
            <table class="table-auto w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
                        <th class="px-4 py-2 border-b">ID</th>
                        <th class="px-4 py-2 border-b">Descrição</th>
                        <th class="px-4 py-2 border-b">Data</th>
                        <th class="px-4 py-2 border-b">Veículo</th>
                        <th class="px-4 py-2 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordens as $ordem)
                        <tr class="text-gray-700 dark:text-gray-300 border-b dark:border-gray-600">
                            <td class="px-4 py-2">{{ $ordem->id }}</td>
                            <td class="px-4 py-2">{{ $ordem->descricao }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($ordem->data_servico)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">
                                @if($ordem->veiculo)
                                    {{ $ordem->veiculo->placa }} - {{ $ordem->veiculo->modelo }}
                                @else
                                    <em>Veículo não encontrado</em>
                                @endif
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('ordens.edit', $ordem->id) }}"
                                   class="px-3 py-1 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                                   ✏️ Editar
                                </a>

                                <form action="{{ route('ordens.destroy', $ordem->id) }}" method="POST" style="display:inline-block;">
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
        <p class="text-gray-700 dark:text-gray-300 mt-4">Nenhuma ordem de serviço cadastrada.</p>
    @endif
</div>
@endsection