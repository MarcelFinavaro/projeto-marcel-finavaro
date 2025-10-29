@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 max-w-xl">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-white">✏️ Editar Ordem de Serviço</h2>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-800 px-4 py-2 rounded shadow">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ordens.update', $ordem->id) }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md space-y-4">
        @csrf
        @method('PUT')

        <!-- Cliente -->
        <div>
            <label for="cliente_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cliente:</label>
            <select name="cliente_id" id="cliente_id" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">
                <option value="">Selecione um cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id', $ordem->cliente_id) == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Veículo -->
        <div>
            <label for="veiculo_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Veículo:</label>
            <select name="veiculo_id" id="veiculo_id" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">
                <option value="">Selecione um veículo</option>
                @foreach ($veiculos as $veiculo)
                    <option value="{{ $veiculo->id }}" {{ old('veiculo_id', $ordem->veiculo_id) == $veiculo->id ? 'selected' : '' }}>
                        {{ $veiculo->modelo }} - {{ $veiculo->placa }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Descrição -->
        <div>
            <label for="descricao" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição:</label>
            <textarea name="descricao" id="descricao" rows="4" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">{{ old('descricao', $ordem->descricao) }}</textarea>
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status:</label>
            <select name="status" id="status" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">
                <option value="aberta" {{ old('status', $ordem->status) == 'aberta' ? 'selected' : '' }}>Aberta</option>
                <option value="em andamento" {{ old('status', $ordem->status) == 'em andamento' ? 'selected' : '' }}>Em andamento</option>
                <option value="concluída" {{ old('status', $ordem->status) == 'concluída' ? 'selected' : '' }}>Concluída</option>
            </select>
        </div>

        <!-- Data -->
        <div>
            <label for="data" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Data:</label>
            <input type="date" name="data" id="data" required value="{{ old('data', $ordem->data) }}"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">
        </div>

        <!-- Botão de envio -->
        <div class="text-center">
            <button type="submit"
                class="px-6 py-2 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 transition">
                💾 Atualizar Ordem
            </button>
        </div>
    </form>
</div>
@endsection