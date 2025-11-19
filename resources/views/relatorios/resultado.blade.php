@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 max-w-2xl">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">📋 Ordens de Serviço Encontradas</h2>

    @if ($ordens->isEmpty())
        <p class="text-center text-gray-600 dark:text-gray-300">Nenhuma OS encontrada para os critérios informados.</p>
    @else
        <form action="{{ route('relatorios.gerar.pdf') }}" method="POST" class="space-y-4">
            @csrf
            <label for="ordem_id" class="block text-sm font-medium text-gray-700 dark:text-white">Selecione uma OS:</label>
            <select name="ordem_id" id="ordem_id" required
                    class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:text-white">
                @foreach ($ordens as $ordem)
                    <option value="{{ $ordem->id }}">
                        OS #{{ $ordem->id }} — Placa: {{ $ordem->veiculo->placa }} — {{ \Carbon\Carbon::parse($ordem->data_servico)->format('d/m/Y') }}
                    </option>
                @endforeach
            </select>

            <button type="submit"
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 rounded-lg transition">
                🧾 Gerar PDF
            </button>
        </form>
    @endif
</div>
@endsection