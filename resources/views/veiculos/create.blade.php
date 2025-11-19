@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 py-10">
    <div class="w-full max-w-xl bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white text-center py-4">
            <h2 class="text-2xl font-bold">Cadastrar Novo Veículo</h2>
        </div>

        <div class="p-6">
            @if ($errors->any())
                <div class="bg-yellow-100 text-yellow-800 p-3 rounded-md mb-4">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @include('veiculos._form', [
                'action' => route('veiculos.store'),
                'method' => 'POST',
                'buttonText' => 'Salvar Veículo',
                'clientes' => $clientes
            ])
        </div>
    </div>
</div>
@endsection