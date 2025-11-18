@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-white text-center">🧾 Nova Ordem de Serviço</h2>

    <form action="{{ route('ordens.store') }}" method="POST" id="formOrdemServico"> 
        @csrf

        {{-- Selecionar cliente por CPF 
        <div class="mb-5">
            <label for="cpf" class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Cliente (CPF)</label>
            <select name="cpf" id="cpf" required
                class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-4 py-2 text-gray-900 dark:text-white">
                <option value="">Selecione um cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->cpf }}" {{ old('cpf') == $cliente->cpf ? 'selected' : '' }}>
                        {{ $cliente->nome }} ({{ $cliente->cpf }})
                    </option>
                @endforeach
            </select>
        </div> --}}

        {{-- Selecionar veículo por placa --}}
        <div class="mb-5">
            <label for="placa" class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Placa do Veículo</label>
            <select name="placa" id="placa" required
                class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-4 py-2 text-gray-900 dark:text-white">
                <option value="">Selecione uma placa</option>
                @foreach ($veiculos as $veiculo)
                    <option value="{{ $veiculo->placa }}" {{ old('placa') == $veiculo->placa ? 'selected' : '' }}>
                        {{ $veiculo->placa }} — {{ $veiculo->modelo }} {{-- ({{ $veiculo->cliente->nome }}) --}}
                    </option>
                @endforeach
            </select>
        </div> 

        {{-- Descrição do problema --}}
        <div class="mb-5">
            <label for="descricao" class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Descrição do Problema</label>
            <textarea name="descricao" id="descricao" rows="4" required
                class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-4 py-2 text-gray-900 dark:text-white">{{ old('descricao') }}</textarea>
        </div>

        {{-- Lista de peças (opcional) --}}
        <div class="mb-5">
            <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Peças Utilizadas (opcional)</label>

            <div id="pecas-container">
                {{-- Nenhuma peça fixa ao carregar --}}
            </div>

            <button type="button" onclick="adicionarPeca()"
                class="mt-2 px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                ➕ Adicionar Peça
            </button>
        </div>
        <div class="mb-5">
            <label for="data_servico" class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Data do Serviço</label>
            <input type="date" name="data_servico" id="data_servico" value="{{ old('data_servico') }}"
                class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:text-white" required>
        </div>

        {{-- Mão de obra --}}
        <div class="mb-5">
            <label for="mao_obra" class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Valor da Mão de Obra (R$)</label>
            <input type="number" name="mao_obra" id="mao_obra" step="0.01" value="{{ old('mao_obra', 0) }}"
                class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:text-white" required>
        </div>

        {{-- Total --}}
        <div class="mb-6">
            <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Total (Peças + Mão de Obra)</label>
            <input type="text" id="total" readonly
                class="w-full px-4 py-2 border rounded bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 cursor-not-allowed">
        </div>

        {{-- Botão --}}
        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
            💾 Salvar Ordem de Serviço
        </button>
    </form>
</div>

{{-- Script para adicionar/remover peças e calcular total --}}
<script>
    let index = 0;

    function adicionarPeca() {
        const container = document.getElementById('pecas-container');
        const div = document.createElement('div');
        div.classList.add('peca', 'flex', 'gap-2', 'mb-2', 'items-center');
        div.innerHTML = `
            <input type="text" name="pecas[${index}][nome_peca]" placeholder="Nome da peça"
                class="w-1/2 px-3 py-2 border rounded dark:bg-gray-700 dark:text-white">
            <input type="number" name="pecas[${index}][quantidade]" placeholder="Qtd" min="1" value="1"
                class="w-1/6 px-3 py-2 border rounded dark:bg-gray-700 dark:text-white">
            <input type="number" name="pecas[${index}][preco_unitario]" placeholder="Valor unitário" step="0.01"
                class="w-1/3 px-3 py-2 border rounded dark:bg-gray-700 dark:text-white preco">
            <button type="button" class="remover-peca text-red-600 hover:text-red-800 text-xl font-bold px-2">🗑️</button>
        `;
        container.appendChild(div);
        index++;
        calcularTotal();
    }

    function calcularTotal() {
        let total = 0;
        document.querySelectorAll('.peca').forEach(div => {
            const qtd = parseFloat(div.querySelector('[name*="[quantidade]"]')?.value) || 0;
            const preco = parseFloat(div.querySelector('[name*="[preco_unitario]"]')?.value) || 0;
            total += qtd * preco;
        });

        const maoObra = parseFloat(document.getElementById('mao_obra')?.value) || 0;
        total += maoObra;

        document.getElementById('total').value = 'R$ ' + total.toFixed(2).replace('.', ',');
    }

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remover-peca')) {
            const div = e.target.closest('.peca');
            div.remove();
            calcularTotal();
        }
    });

    document.addEventListener('input', calcularTotal);
    document.addEventListener('DOMContentLoaded', calcularTotal);
</script>
@endsection