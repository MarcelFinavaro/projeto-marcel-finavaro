<!DOCTYPE html>
<html lang="pt-BR" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistema OS') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Flowbite -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">

            <!-- LOGO -->
            <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800 dark:text-white">
                Sistema OS
            </a>

            <!-- LINKS DESKTOP -->
            <div class="hidden md:flex space-x-8">

                <!-- CLIENTES -->
                <div class="relative">
                    <button id="clientesMenu" data-dropdown-toggle="clientesDropdown"
                        class="text-gray-700 dark:text-gray-200 hover:text-blue-600">
                        Clientes
                    </button>
                    <div id="clientesDropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                            <li><a href="{{ route('clientes.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Listar Clientes</a></li>
                            <li><a href="{{ route('clientes.create') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Cadastrar Cliente</a></li>
                        </ul>
                    </div>
                </div>

                <!-- VEÍCULOS -->
                <div class="relative">
                    <button id="veiculosMenu" data-dropdown-toggle="veiculosDropdown"
                        class="text-gray-700 dark:text-gray-200 hover:text-blue-600">
                        Veículos
                    </button>
                    <div id="veiculosDropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                            <li><a href="{{ route('veiculos.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Listar Veículos</a></li>
                            <li><a href="{{ route('veiculos.create') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Cadastrar Veículo</a></li>
                        </ul>
                    </div>
                </div>

                <!-- ORDENS -->
                <div class="relative">
                    <button id="ordensMenu" data-dropdown-toggle="ordensDropdown"
                        class="text-gray-700 dark:text-gray-200 hover:text-blue-600">
                        Ordens de Serviço
                    </button>
                    <div id="ordensDropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                            <li><a href="{{ route('ordens.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Listar Ordens</a></li>
                            <li><a href="{{ route('ordens.create') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Nova OS</a></li>
                        </ul>
                    </div>
                </div>

                <!-- RELATÓRIOS -->
                <a href="{{ route('relatorios.index') }}"
                    class="text-gray-700 dark:text-gray-200 hover:text-blue-600">
                    Relatórios
                </a>
            </div>

            <!-- BOTÕES DIREITA -->
            <div class="flex items-center space-x-3">

                <!-- BOTÃO TEMA -->
                <button id="themeToggle" class="p-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-200">
                    🌙
                </button>

                <!-- Usuário -->
                @auth
                    <div class="relative">
                        <button data-dropdown-toggle="userMenu" class="text-gray-700 dark:text-gray-200 hover:text-blue-600">
                            {{ Auth::user()->name }}
                        </button>

                        <div id="userMenu"
                            class="hidden z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                <li><a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Perfil</a></li>
                            </ul>
                            <div class="py-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        Sair
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>

        </div>
    </nav>

    <!-- CONTEÚDO -->
    <main class="p-6">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

</body>
</html>
