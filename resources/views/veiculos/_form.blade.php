<form action="{{ $action }}" method="POST" id="formVeiculo" novalidate>
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    {{-- Placa (não editável na edição) --}}
    <div class="relative mb-5">
        @if ($method === 'PUT')
            <input type="text" id="placa" value="{{ $veiculo->placa }}"
                disabled
                class="peer w-full rounded-lg border px-3 pt-5 pb-2 bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 placeholder-transparent cursor-not-allowed" />
            <input type="hidden" name="placa" value="{{ $veiculo->placa }}">
        @else
            <input type="text" name="placa" id="placa" autocomplete="off"
                class="peer w-full rounded-lg border px-3 pt-5 pb-2 bg-transparent text-gray-900 dark:text-white placeholder-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                placeholder="Placa" value="{{ old('placa', $veiculo->placa ?? '') }}" required>
        @endif
        <label for="placa"
            class="absolute left-3 top-2 text-sm text-gray-500 dark:text-gray-400 peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
            Placa
        </label>
    </div>

    {{-- Modelo --}}
    <div class="relative mb-5">
        <input type="text" name="modelo" id="modelo" autocomplete="off"
            class="peer w-full rounded-lg border px-3 pt-5 pb-2 bg-transparent text-gray-900 dark:text-white placeholder-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
            placeholder="Modelo" value="{{ old('modelo', $veiculo->modelo ?? '') }}" required>
        <label for="modelo"
            class="absolute left-3 top-2 text-sm text-gray-500 dark:text-gray-400 peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
            Modelo
        </label>
    </div>

    {{-- Marca --}}
    <div class="relative mb-5">
        <input type="text" name="marca" id="marca" autocomplete="off"
            class="peer w-full rounded-lg border px-3 pt-5 pb-2 bg-transparent text-gray-900 dark:text-white placeholder-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
            placeholder="Marca" value="{{ old('marca', $veiculo->marca ?? '') }}" required>
        <label for="marca"
            class="absolute left-3 top-2 text-sm text-gray-500 dark:text-gray-400 peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
            Marca
        </label>
    </div>

    {{-- Ano --}}
    <div class="relative mb-6">
        <input type="text" name="ano" id="ano" autocomplete="off"
            class="peer w-full rounded-lg border px-3 pt-5 pb-2 bg-transparent text-gray-900 dark:text-white placeholder-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
            placeholder="Ano" value="{{ old('ano', $veiculo->ano ?? '') }}" required>
        <label for="ano"
            class="absolute left-3 top-2 text-sm text-gray-500 dark:text-gray-400 peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
            Ano
        </label>
    </div>

    {{-- Cliente --}}
    <div class="relative mb-6">
        <select name="cliente_id" id="cliente_id"
            class="peer w-full rounded-lg border px-3 pt-5 pb-2 bg-transparent text-gray-900 dark:text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
            required>
            <option value="">Selecione um cliente</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}"
                    {{ old('cliente_id', $veiculo->cliente_id ?? '') == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->nome }}
                </option>
            @endforeach
        </select>
        <label for="cliente_id"
            class="absolute left-3 top-2 text-sm text-gray-500 dark:text-gray-400 peer-focus:text-blue-500">
            Cliente
        </label>
    </div>

    {{-- Botão --}}
    <button type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
        {{ $buttonText }}
    </button>
</form>