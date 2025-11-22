@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 py-10">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white text-center py-4">
            <h2 class="text-2xl font-bold">Editar Cliente</h2>
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

            {{-- ✅ Aqui está a inclusão do formulário padrão --}}
            @include('clientes._form', [
                'action' => route('clientes.update', $cliente->id),
                'method' => 'PUT',
                'buttonText' => 'Atualizar Cliente',
                'cliente' => $cliente
            ])
        </div>
    </div>
</div>
@endsection
