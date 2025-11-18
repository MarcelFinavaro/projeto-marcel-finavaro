@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 max-w-3xl">
    <h2 class="text-3xl font-bold mb-8 text-center text-gray-800 dark:text-white">📊 Relatórios da Oficina</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Relatório por placa --}}
        <a href="{{ route('relatorios.placa') }}"
           class="block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-lg shadow text-center transition">
            🚗 Relatório por Placa
        </a>

        {{-- Relatório por data --}}
        <a href="{{ route('relatorios.data') }}"
           class="block bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-6 rounded-lg shadow text-center transition">
            📅 Relatório por Período
        </a>

        {{-- Relatório geral de OSs 
        <a href="{{ route('ordens.relatorio.pdf') }}"
           class="block bg-purple-600 hover:bg-purple-700 text-white font-semibold py-4 px-6 rounded-lg shadow text-center transition">
            📁 Relatório Geral de OSs
        </a>

         Relatório personalizado (em breve) 
        <a href="#" class="block bg-gray-400 text-white font-semibold py-4 px-6 rounded-lg shadow text-center cursor-not-allowed">
            🛠️ Relatório Personalizado (em breve)
        </a> --}}
    </div>
</div>
@endsection