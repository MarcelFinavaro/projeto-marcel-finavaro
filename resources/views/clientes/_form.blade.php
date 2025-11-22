<form action="{{ $action }}" method="POST" id="formCliente" novalidate class="space-y-4 md:space-y-6">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    {{-- CPF (não editável na edição) --}}
    <div class="relative">
        @if ($method === 'PUT')
            <input type="text" id="cpf" value="{{ $cliente->cpf }}"
                disabled
                class="peer w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 px-3 md:px-4 pt-5 md:pt-6 pb-2 text-gray-500 dark:text-gray-400 placeholder-transparent cursor-not-allowed text-sm md:text-base" />
            <input type="hidden" name="cpf" value="{{ $cliente->cpf }}">
        @else
            <input type="text" name="cpf" id="cpf" autocomplete="off"
                class="peer w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 md:px-4 pt-5 md:pt-6 pb-2 text-gray-900 dark:text-white placeholder-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm md:text-base"
                placeholder="CPF" value="{{ old('cpf', $cliente->cpf ?? '') }}" required>
        @endif
        <label for="cpf"
            class="absolute left-3 md:left-4 top-2 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
            CPF
        </label>
    </div>

    {{-- Nome --}}
    <div class="relative">
        <input type="text" name="nome" id="nome" autocomplete="off"
            class="peer w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 md:px-4 pt-5 md:pt-6 pb-2 text-gray-900 dark:text-white placeholder-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm md:text-base"
            placeholder="Nome" value="{{ old('nome', $cliente->nome ?? '') }}" required>
        <label for="nome"
            class="absolute left-3 md:left-4 top-2 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
            Nome
        </label>
    </div>

    {{-- Telefone --}}
    <div class="relative">
        <input type="text" name="telefone" id="telefone" autocomplete="off"
            class="peer w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 md:px-4 pt-5 md:pt-6 pb-2 text-gray-900 dark:text-white placeholder-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm md:text-base"
            placeholder="Telefone" value="{{ old('telefone', $cliente->telefone ?? '') }}" required>
        <label for="telefone"
            class="absolute left-3 md:left-4 top-2 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
            Telefone
        </label>
    </div>

    {{-- E-mail --}}
    <div class="relative">
        <input type="email" name="email" id="email" autocomplete="off"
            class="peer w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 md:px-4 pt-5 md:pt-6 pb-2 text-gray-900 dark:text-white placeholder-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm md:text-base"
            placeholder="E-mail" value="{{ old('email', $cliente->email ?? '') }}" required>
        <label for="email"
            class="absolute left-3 md:left-4 top-2 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
            E-mail
        </label>
    </div>

    {{-- Botões Responsivos --}}
    <div class="flex flex-col sm:flex-row gap-3 pt-2">
        <button type="submit"
            class="w-full sm:flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg text-sm md:text-base">
            {{ $buttonText }}
        </button>
        
        <a href="{{ route('clientes.index') }}"
           class="w-full sm:flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg flex items-center justify-center text-sm md:text-base">
            ↩️ Voltar
        </a>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Máscara para CPF
    const cpfInput = document.getElementById('cpf');
    if (cpfInput && !cpfInput.disabled) {
        cpfInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                e.target.value = value;
            }
        });
    }

    // Máscara para Telefone
    const telefoneInput = document.getElementById('telefone');
    if (telefoneInput) {
        telefoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                if (value.length <= 10) {
                    value = value.replace(/(\d{2})(\d)/, '($1) $2');
                    value = value.replace(/(\d{4})(\d)/, '$1-$2');
                } else {
                    value = value.replace(/(\d{2})(\d)/, '($1) $2');
                    value = value.replace(/(\d{5})(\d)/, '$1-$2');
                }
                e.target.value = value;
            }
        });
    }

    // Prevenir zoom em mobile (iOS)
    if (window.innerWidth < 768) {
        const inputs = document.querySelectorAll('input[type="text"], input[type="email"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.fontSize = '16px';
            });
        });
    }
});
</script>