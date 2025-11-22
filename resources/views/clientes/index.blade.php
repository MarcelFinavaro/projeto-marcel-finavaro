@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white text-center">👤 Clientes</h2>

    @if (session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded-full shadow">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 px-4 py-2 bg-red-100 text-red-800 rounded-full shadow">
            {{ session('error') }}
        </div>
    @endif

    <!-- Botão Novo Cliente -->
    <div class="flex justify-center mb-4">
        <a href="{{ route('clientes.create') }}"
           class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg shadow-md transition-all duration-300 flex items-center space-x-2">
            <span>➕</span>
            <span>Novo Cliente</span>
        </a>
    </div>

    <!-- Pesquisa -->
    <form method="GET" action="{{ route('clientes.index') }}" class="mb-4 flex justify-center">
        <input
            type="text"
            name="search"
            placeholder="🔍 Buscar por nome"
            value="{{ request('search') }}"
            class="px-4 py-2 border rounded-l-full focus:outline-none focus:ring focus:border-blue-300 dark:bg-gray-700 dark:text-white"
        >
        <button
            type="submit"
            class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-r-full shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition"
        >
            Buscar
        </button>
    </form>

    @if ($clientes->count())
        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
            <table class="table-auto w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
                        <th class="px-4 py-2 border-b">CPF</th>
                        <th class="px-4 py-2 border-b">Nome</th>
                        <th class="px-4 py-2 border-b">Telefone</th>
                        <th class="px-4 py-2 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr class="text-gray-700 dark:text-gray-300 border-b dark:border-gray-600">
                            <td class="px-4 py-2">{{ $cliente->cpf }}</td>
                            <td class="px-4 py-2">{{ $cliente->nome }}</td>
                            <td class="px-4 py-2">{{ $cliente->telefone }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('clientes.edit', $cliente->id) }}"
                                   class="px-3 py-1 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                                   ✏️ Editar
                                </a>
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;">
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
        <p class="text-gray-700 dark:text-gray-300 mt-4">Nenhum cliente cadastrado.</p>
    @endif
</div>
@endsection