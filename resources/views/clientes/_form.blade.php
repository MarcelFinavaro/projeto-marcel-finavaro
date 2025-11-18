<form action="{{ $action }}" method="POST" id="formCliente" novalidate>
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    {{-- CPF (não editável na edição) --}}
    <div class="relative mb-5">
        @if ($method === 'PUT')
            <input type="text" id="cpf" value="{{ $cliente->cpf }}"
                disabled
                class="peer w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 px-3 pt-5 pb-2 text-gray-500 dark:text-gray-400 placeholder-transparent cursor-not-allowed" />
            <input type="hidden" name="cpf" value="{{ $cliente->cpf }}">
        @else
            <input type="text" name="cpf" id="cpf" autocomplete="off"
                class="peer w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 pt-5 pb-2 text-gray-900 dark:text-white placeholder-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                placeholder="CPF" value="{{ old('cpf', $cliente->cpf ?? '') }}" required>
        @endif
        <label for="cpf"
            class="absolute left-3 top-2 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
            CPF
        </label>
    </div>

    {{-- Nome --}}
    <div class="relative mb-5">
        <input type="text" name="nome" id="nome" autocomplete="off"
            class="peer w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 pt-5 pb-2 text-gray-900 dark:text-white placeholder-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
            placeholder="Nome" value="{{ old('nome', $cliente->nome ?? '') }}" required>
        <label for="nome"
            class="absolute left-3 top-2 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
            Nome
        </label>
    </div>

    {{-- Telefone --}}
    <div class="relative mb-5">
        <input type="text" name="telefone" id="telefone" autocomplete="off"
            class="peer w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 pt-5 pb-2 text-gray-900 dark:text-white placeholder-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
            placeholder="Telefone" value="{{ old('telefone', $cliente->telefone ?? '') }}" required>
        <label for="telefone"
            class="absolute left-3 top-2 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
            Telefone
        </label>
    </div>

    {{-- E-mail --}}
    <div class="relative mb-6">
        <input type="email" name="email" id="email" autocomplete="off"
            class="peer w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 pt-5 pb-2 text-gray-900 dark:text-white placeholder-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
            placeholder="E-mail" value="{{ old('email', $cliente->email ?? '') }}" required>
        <label for="email"
            class="absolute left-3 top-2 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
            E-mail
        </label>
    </div>

    {{-- Botão --}}
    <button type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
        {{ $buttonText }}
    </button>
</form>