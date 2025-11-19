@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 max-w-xl">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">🚗 Relatório por Placa</h2>

    <form action="{{ route('relatorios.placa.buscar') }}" method="POST" class="space-y-4">
        @csrf
        <label for="placa" class="block text-sm font-medium text-gray-700 dark:text-white">Digite a placa:</label>
        <input type="text" name="placa" id="placa" required
               class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:text-white">

        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
            🔍 Buscar OSs
        </button>
    </form>
</div>
@endsection