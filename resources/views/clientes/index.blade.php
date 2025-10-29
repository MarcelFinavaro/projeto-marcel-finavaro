@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white">👤 Clientes</h2>

    {{-- Campos de busca por nome e CPF --}}
    @if (request()->routeIs('clientes.index'))
        <section class="text-center mb-8">
            <h3 class="text-lg sm:text-xl font-bold text-orange-500 mb-2">🔍 Buscar cliente</h3>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Localize clientes por nome ou CPF.</p>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-6">
                {{-- Busca por nome --}}
                <form action="{{ route('clientes.buscar.nome') }}" method="GET"
                    class="flex items-center gap-3 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                    <input type="text" name="nome" placeholder="Digite o nome" required
                        class="w-48 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">
                    <button type="submit"
                        class="px-4 py-2 bg-orange-500 text-white text-sm font-semibold rounded-md hover:bg-orange-600 transition">
                        Buscar Nome
                    </button>
                </form>

                {{-- Busca por CPF --}}
                <form action="{{ route('clientes.buscar.cpf') }}" method="GET"
                    class="flex items-center gap-3 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                    <input type="text" name="cpf" maxlength="14" placeholder="Digite o CPF" required
                        class="w-48 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">
                    <button type="submit"
                        class="px-4 py-2 bg-orange-500 text-white text-sm font-semibold rounded-md hover:bg-orange-600 transition">
                        Buscar CPF
                    </button>
                </form>
            </div>
        </section>
    @endif

    {{-- Mensagem de sucesso --}}
    @if (session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded-full shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- Botão de novo cliente --}}
    <a href="{{ route('clientes.create') }}"
       class="inline-block mb-4 px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition">
       ➕ Novo Cliente
    </a>

    {{-- Tabela de clientes --}}
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
                                <a href="{{ route('clientes.edit', $cliente->cpf) }}"
                                   class="px-3 py-1 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                                   ✏️ Editar
                                </a>
                                <form action="{{ route('clientes.destroy', $cliente->cpf) }}" method="POST" style="display:inline-block;">
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