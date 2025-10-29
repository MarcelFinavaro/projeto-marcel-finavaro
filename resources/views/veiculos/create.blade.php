@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 max-w-xl">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-white">➕ Cadastrar Novo Veículo</h2>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-800 px-4 py-2 rounded shadow">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('veiculos.store') }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md space-y-4">
        @csrf

        <!-- Placa -->
        <div>
            <label for="placa" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Placa:</label>
            <input type="text" name="placa" id="placa" maxlength="8" required value="{{ old('placa') }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">
        </div>

        <!-- Modelo -->
        <div>
            <label for="modelo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Modelo:</label>
            <input type="text" name="modelo" id="modelo" required value="{{ old('modelo') }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">
        </div>

        <!-- Marca -->
        <div>
            <label for="marca" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Marca:</label>
            <input type="text" name="marca" id="marca" required value="{{ old('marca') }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">
        </div>

        <!-- Ano -->
        <div>
            <label for="ano" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ano:</label>
            <input type="number" name="ano" id="ano" required value="{{ old('ano') }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">
        </div>

        <!-- Cliente -->
        <div>
            <label for="cliente_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cliente:</label>
            <select name="cliente_id" id="cliente_id" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">
                <option value="">Selecione um cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Botão de envio -->
        <div class="text-center">
            <button type="submit"
                class="px-6 py-2 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 transition">
                💾 Salvar Veículo
            </button>
        </div>
    </form>
</div>
@endsection