<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Script de tema automático -->
    <script>
        (function() {
            const storedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-500">

    <div class="min-h-screen flex flex-col">

        <!-- NAVBAR -->
        <nav class="backdrop-blur-md bg-gray-200/80 dark:bg-gray-800/70 border-b border-gray-300 dark:border-gray-700 shadow-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <span class="text-2xl">🚗</span>
                    <h1 class="text-xl font-bold text-gray-900 dark:text-white tracking-tight">
                        O.S <span class="text-orange-500">Oficina</span>
                    </h1>
                </div>

                <ul class="flex space-x-3 items-center">
                    @php
                        $links = [
                            ['Dashboard', route('dashboard')],
                            ['Clientes', route('clientes.index')],
                            ['Veículos', route('veiculos.index')],
                            ['Ordens', route('ordens.index')],
                            ['Relatórios', route('relatorios.index')],
                        ];
                    @endphp

                    @foreach ($links as [$label, $url])
                        <li>
                            <a href="{{ $url }}"
                                class="px-4 py-2 rounded-full bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white font-medium hover:bg-orange-500 hover:text-white transition-all duration-300 shadow-sm">
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach

                    <li>
                        <button id="theme-toggle"
                                class="px-4 py-2 rounded-full bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white font-medium hover:bg-orange-500 hover:text-white transition-all duration-300 shadow-sm">
                            🌗 Tema
                        </button>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="px-4 py-2 rounded-full bg-red-500 text-white font-semibold hover:bg-red-600 transition-all duration-300 shadow-md">
                                🔓 Sair
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- SEÇÃO DE APRESENTAÇÃO -->
        <section class="max-w-4xl mx-auto mt-10 bg-white/90 dark:bg-gray-800/80 rounded-xl shadow-xl p-8 text-center backdrop-blur-md">
            <h2 class="text-3xl font-bold text-orange-500 mb-4">
                Organize sua oficina com mais agilidade!
            </h2>
            <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                Gerencie ordens de serviço com eficiência e profissionalismo, 
                oferecendo uma experiência moderna e organizada aos seus clientes.
            </p>
        </section>

        <!-- ÁREA DE PESQUISA DINÂMICA -->
        @auth
        <section class="flex flex-col justify-center items-center flex-grow px-4 py-10">
            <div class="bg-white/90 dark:bg-gray-800/80 backdrop-blur-md rounded-2xl shadow-xl p-8 w-full max-w-md text-center border border-gray-200 dark:border-gray-700">
                
               {{-- ===== CLIENTES ===== --}}
                @if (Route::is('clientes.index'))
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">👤 Clientes</h3>

                    <div class="flex justify-center">
                        <a href="{{ route('clientes.create') }}"
                            class="px-6 py-3 bg-orange-500 text-white font-semibold rounded-full shadow-md hover:bg-orange-600 active:scale-95 transition-all duration-300">
                            ➕ Cadastrar Novo Cliente
                        </a>
                    </div>

               

                {{-- ===== VEÍCULOS ===== --}}
                @elseif (Route::is('veiculos.index'))
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">🚘 Buscar Veículo</h3>
                    <form action="{{ route('veiculos.index') }}" method="GET" class="flex flex-col gap-5">
                        <div class="flex items-center bg-gray-100 dark:bg-gray-700 rounded-full shadow-inner px-4 py-2 focus-within:ring-2 focus-within:ring-orange-500 transition">
                            <span class="text-gray-400 dark:text-gray-300 mr-2">🔤</span>
                            <input type="text" name="placa" maxlength="8" placeholder="Digite a placa (ex: ABC1D23)"
                                class="flex-grow bg-transparent focus:outline-none text-center text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 text-sm tracking-wide">
                        </div>
                        <div class="flex justify-center gap-3">
                            <a href="{{ route('veiculos.create') }}"
                                class="px-5 py-2 bg-orange-500 text-white font-semibold rounded-full shadow-md hover:bg-orange-600 active:scale-95 transition-all duration-300">
                                ➕ Novo Veículo
                            </a>
                            <button type="submit"
                                class="px-5 py-2 bg-gray-300 dark:bg-gray-600 text-gray-900 dark:text-white rounded-full shadow-md hover:bg-gray-400 dark:hover:bg-gray-500 active:scale-95 transition-all duration-300">
                                Pesquisar 🔎
                            </button>
                        </div>
                    </form>

                {{-- ===== ORDENS ===== --}}
                @elseif (Route::is('ordens.index'))
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">🧾 Ordens de Serviço</h3>
                    <form action="{{ route('ordens.index') }}" method="GET" class="flex flex-col gap-5">
                        <div class="flex items-center bg-gray-100 dark:bg-gray-700 rounded-full shadow-inner px-4 py-2 focus-within:ring-2 focus-within:ring-orange-500 transition">
                            <span class="text-gray-400 dark:text-gray-300 mr-2">🔎</span>
                            <input type="text" name="ordem" placeholder="Buscar por número ou cliente"
                                class="flex-grow bg-transparent focus:outline-none text-center text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 text-sm tracking-wide">
                        </div>
                        <div class="flex justify-center gap-3">
                            <a href="{{ route('ordens.create') }}"
                                class="px-5 py-2 bg-orange-500 text-white font-semibold rounded-full shadow-md hover:bg-orange-600 active:scale-95 transition-all duration-300">
                                ➕ Nova Ordem
                            </a>
                            <button type="submit"
                                class="px-5 py-2 bg-gray-300 dark:bg-gray-600 text-gray-900 dark:text-white rounded-full shadow-md hover:bg-gray-400 dark:hover:bg-gray-500 active:scale-95 transition-all duration-300">
                                Pesquisar 🔍
                            </button>
                        </div>
                    </form>
                    
                {{-- ===== RELATÓRIOS ===== --}}
                @elseif (Route::is('relatorios.index'))
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">📊 Relatórios</h3>
                @endif
                </div>
            </section>
           @endauth



        <!-- CONTEÚDO PRINCIPAL -->
        <main class="flex-grow px-6 py-8">
            @yield('content')
        </main>

        <!-- RODAPÉ INSTITUCIONAL -->
        <section class="bg-gray-100 dark:bg-gray-900 border-t border-gray-300 dark:border-gray-700 px-4 py-6 text-center">
            <h1 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white">
                📘 Sistema Web de Gestão de Ordens de Serviço
            </h1>
            <p class="text-sm sm:text-base mt-1 text-orange-500 font-medium">
                Projeto Tecnológico em Desenvolvimento de Sistemas
            </p>
            <div class="mt-3 text-xs sm:text-sm text-gray-700 dark:text-gray-300 space-y-1">
                <p>👨💻 <strong class="text-gray-800 dark:text-gray-200">Marcel Fernando Finavaro</strong></p>
                <p>📧 <a href="mailto:marcelfinavaro@rede.ulbra.br" class="underline hover:text-orange-500">marcelfinavaro@rede.ulbra.br</a></p>
                <p>📞 <a href="tel:+5551993577787" class="hover:text-orange-500">Fone: (51) 99357-7787</a></p>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="bg-gray-200 dark:bg-gray-950 text-center py-4 text-sm text-gray-700 dark:text-gray-400 border-t border-gray-300 dark:border-gray-700">
            © {{ date('Y') }} O.S Oficina. Todos os direitos reservados.
        </footer>

    </div>

    <!-- Script alternância de tema -->
    <script>
        document.getElementById('theme-toggle').addEventListener('click', () => {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    </script>

</body>
</html>

