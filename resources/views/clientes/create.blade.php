@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 py-10">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white text-center py-4">
            <h2 class="text-2xl font-bold">Cadastrar Novo Cliente</h2>
        </div>

        <div class="p-6">
            @if (session('error'))
                <div class="alert alert-danger text-center mb-3">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-yellow-100 text-yellow-800 p-3 rounded-md mb-4">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('clientes.store') }}" method="POST" id="formCliente" novalidate>
                @csrf

                <div class="relative mb-5">
                    <input type="text" name="cpf" id="cpf" autocomplete="off"
                        class="peer w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 pt-5 pb-2 text-gray-900 dark:text-white placeholder-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="CPF" value="{{ old('cpf') }}" required>
                    <label for="cpf"
                        class="absolute left-3 top-2 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
                        CPF
                    </label>
                </div>

                <div class="relative mb-5">
                    <input type="text" name="nome" id="nome" autocomplete="off"
                        class="peer w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 pt-5 pb-2 text-gray-900 dark:text-white placeholder-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Nome" value="{{ old('nome') }}" required>
                    <label for="nome"
                        class="absolute left-3 top-2 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
                        Nome
                    </label>
                </div>

                <div class="relative mb-5">
                    <input type="text" name="telefone" id="telefone" autocomplete="off"
                        class="peer w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 pt-5 pb-2 text-gray-900 dark:text-white placeholder-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Telefone" value="{{ old('telefone') }}" required>
                    <label for="telefone"
                        class="absolute left-3 top-2 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
                        Telefone
                    </label>
                </div>

                <div class="relative mb-6">
                    <input type="email" name="email" id="email" autocomplete="off"
                        class="peer w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-3 pt-5 pb-2 text-gray-900 dark:text-white placeholder-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="E-mail" value="{{ old('email') }}" required>
                    <label for="email"
                        class="absolute left-3 top-2 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-sm peer-focus:text-blue-500">
                        E-mail
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                    Salvar Cliente
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cpf = document.getElementById('cpf');
    const telefone = document.getElementById('telefone');

    cpf.addEventListener('input', function(e) {
        let v = e.target.value.replace(/\D/g, '');
        if (v.length > 11) v = v.slice(0, 11);
        v = v.replace(/(\d{3})(\d)/, '$1.$2');
        v = v.replace(/(\d{3})(\d)/, '$1.$2');
        v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        e.target.value = v;
    });

    telefone.addEventListener('input', function(e) {
        let v = e.target.value.replace(/\D/g, '');
        if (v.length > 11) v = v.slice(0, 11);
        v = v.replace(/^(\d{2})(\d)/g, '($1) $2');
        v = v.replace(/(\d{5})(\d)/, '$1-$2');
        e.target.value = v;
    });
});
</script>
@endsection
