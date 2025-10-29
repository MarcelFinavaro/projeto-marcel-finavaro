@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl mt-8">
    <h1 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-white">📊 Relatórios</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Card de Relatório de Ordens -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-2">Ordens de Serviço</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-4">Gere um relatório completo em PDF com todas as ordens registradas.</p>
            <a href="{{ route('ordens.relatorio.pdf') }}"
               class="inline-block px-5 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
               📄 Gerar PDF
            </a>
        </div>

        <!-- Card de Relatório por Placa -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-2">Relatório por Placa</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-4">Digite a placa do veículo para gerar um relatório completo.</p>
            <form method="GET" onsubmit="this.action='/relatorios/veiculo/' + this.placa.value">
                <input type="text" name="placa" placeholder="Digite a placa" required
                    class="w-full mb-3 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">
                <button type="submit"
                    class="w-full px-5 py-2 bg-orange-500 text-white rounded-full shadow hover:bg-orange-600 transition">
                    📄 Gerar Relatório
                </button>
            </form>
        </div>

        <!-- Card de Relatório de Clientes (em breve) -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-2">Relatório de Clientes</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-4">(Exemplo) Relatório com dados dos clientes cadastrados.</p>
            <button
                class="px-5 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition"
                disabled
            >
                🚧 Em breve
            </button>
        </div>
    </div>
</div>
@endsection