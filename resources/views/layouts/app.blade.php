<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

    <button
    onclick="document.documentElement.classList.toggle('dark')"
    class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition"
>
    🌗 Alternar tema
    </button>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">

         <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            
             <nav class="bg-white dark:bg-gray-900 shadow px-6 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-gray-800 dark:text-white">
                🚗 O.S OFICINA
            </div>
            <ul class="flex space-x-6 text-gray-700 dark:text-gray-200 font-medium">
                <li><a href="{{ route('dashboard') }}" class="hover:text-blue-500">Dashboard</a></li>
                <li><a href="{{ route('clientes.index') }}" class="hover:text-blue-500">Cadastro de Clientes</a></li>
                <li><a href="{{ route('veiculos.index') }}" class="hover:text-blue-500">Cadastro de Veículos</a></li>
                <li><a href="{{ route('ordens.index') }}" class="hover:text-blue-500">Ordens de Serviço</a></li>
                <li><a href="{{ route('relatorios.index') }}" class="hover:text-blue-500">Relatórios</a></li>
            </ul>
            <button
                onclick="document.documentElement.classList.toggle('dark')"
                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition"
            >
                🌗 Tema
            </button>
        </nav>


           <!-- @include('layouts.navigation') -->

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
    @yield('content')
      </main>

        </div>
      </body>
</html>

 