@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 max-w-xl">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-white">➕ Cadastrar Novo Cliente</h2>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-800 px-4 py-2 rounded shadow">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.store') }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md space-y-4">
        @csrf

        <!-- CPF -->
        <div>
            <label for="cpf" class="block text-sm font-medium text-gray-700 dark:text-gray-300">CPF:</label>
            <input type="text" name="cpf" id="cpf" maxlength="14" required value="{{ old('cpf') }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">
        </div>

        <!-- Nome -->
        <div>
            <label for="nome" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome:</label>
            <input type="text" name="nome" id="nome" required value="{{ old('nome') }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">
        </div>

        <!-- Telefone -->
        <div>
            <label for="telefone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Telefone:</label>
            <input type="text" name="telefone" id="telefone" required value="{{ old('telefone') }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">E-mail:</label>
            <input type="email" name="email" id="email" required value="{{ old('email') }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">
        </div>

        <!-- Botão de envio -->
        <div class="text-center">
            <button type="submit"
                class="px-6 py-2 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 transition">
                💾 Salvar Cliente
            </button>
        </div>
    </form>
</div>
@endsection