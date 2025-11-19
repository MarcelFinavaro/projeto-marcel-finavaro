@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 max-w-xl">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">📅 Relatório por Período</h2>

    <form action="{{ route('relatorios.data.buscar') }}" method="POST" class="space-y-4">
        @csrf
        <label for="data_inicio" class="block text-sm font-medium text-gray-700 dark:text-white">Data início:</label>
        <input type="date" name="data_inicio" id="data_inicio" required
               class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:text-white">

        <label for="data_fim" class="block text-sm font-medium text-gray-700 dark:text-white">Data fim:</label>
        <input type="date" name="data_fim" id="data_fim" required
               class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:text-white">

        <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-lg transition">
            🔍 Buscar OSs
        </button>
    </form>
</div>
@endsection