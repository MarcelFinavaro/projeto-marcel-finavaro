@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white">👤 Clientes</h2>

    @if (session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded-full shadow">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('clientes.create') }}"
       class="inline-block mb-4 px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition">
       ➕ Novo Cliente
    </a>

    @if ($clientes->count())
        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
            <table class="table-auto w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
                        <th class="px-4 py-2 border-b">ID</th>
                        <th class="px-4 py-2 border-b">Nome</th>
                        <th class="px-4 py-2 border-b">Telefone</th>
                        <th class="px-4 py-2 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr class="text-gray-700 dark:text-gray-300 border-b dark:border-gray-600">
                            <td class="px-4 py-2">{{ $cliente->id }}</td>
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