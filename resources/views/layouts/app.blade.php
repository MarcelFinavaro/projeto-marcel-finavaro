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

    <!-- Tema automático -->
    <script>
        (function() {
            const storedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>

<body class="font-sans bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition duration-500">

<div class="min-h-screen flex flex-col">

    <!-- 🔶 NAVBAR Principal -->
    <nav class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md border-b border-gray-300 dark:border-gray-700 fixed w-full z-50 shadow-sm">

        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <!-- LOGO -->
            <div class="flex items-center space-x-2">
                <span class="text-2xl">🚗</span>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">
                    O.S <span class="text-orange-500">Oficina</span>
                </h1>
            </div>

            <!-- MENU DESKTOP -->
            <div class="hidden md:flex items-center space-x-2">

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
                <a href="{{ $url }}"
                   class="px-4 py-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white hover:bg-orange-500 hover:text-white transition">
                    {{ $label }}
                </a>
                @endforeach

                <!-- Botão Tema -->
                <button id="theme-toggle"
                        class="px-4 py-2 rounded-full bg-gray-200 dark:bg-gray-700 hover:bg-orange-500 hover:text-white transition">
                    🌗
                </button>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button
                        class="px-4 py-2 rounded-full bg-red-500 text-white font-semibold hover:bg-red-600 transition">
                        Sair
                    </button>
                </form>
            </div>

            <!-- MENU MOBILE - HAMBÚRGUER -->
            <button data-collapse-toggle="mobile-menu" type="button"
                    class="md:hidden p-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700"
            >
                ☰
            </button>
        </div>

        <!-- DROPDOWN MOBILE -->
        <div id="mobile-menu" class="hidden md:hidden px-4 pb-4 space-y-2">

            @foreach ($links as [$label, $url])
            <a href="{{ $url }}"
               class="block w-full px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white hover:bg-orange-500 hover:text-white transition">
                {{ $label }}
            </a>
            @endforeach

            <!-- Tema -->
            <button id="theme-toggle-mobile"
                    class="w-full px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-orange-500 hover:text-white transition">
                🌗 Alternar Tema
            </button>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="w-full px-4 py-2 mt-1 rounded-lg bg-red-500 text-white hover:bg-red-600 transition">
                    Sair
                </button>
            </form>
        </div>
    </nav>

    <!-- Espaço abaixo da navbar -->
    <div class="pt-24"></div>

    <!-- 🔶 TEXTO DA PÁGINA PRINCIPAL (APENAS EM ROTAS PERMITIDAS) -->
    @auth
        @if (!Route::is('clientes.index')
            && !Route::is('veiculos.index')
            && !Route::is('ordens.index')
            && !Route::is('relatorios.index'))
            <section class="max-w-4xl mx-auto mt-6 bg-white/90 dark:bg-gray-800/80 rounded-xl shadow p-8 text-center">
                <h2 class="text-3xl font-bold text-orange-500 mb-3">
                    Agilidade e organização para sua oficina!
                </h2>
                <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                    Este sistema permite gerenciar clientes, veículos e ordens de serviço de forma simples,
                    moderna e totalmente integrada, trazendo mais controle e eficiência para sua oficina mecânica.
                </p>
            </section>
        @endif
    @endauth

    <!-- 🔶 ÁREA DINÂMICA DE PESQUISAS E CADASTROS -->
    <main class="flex-grow px-6 py-8">
        @yield('content')
    </main>

    <!-- 🔶 RODAPÉ INSTITUCIONAL -->
    <section class="bg-gray-100 dark:bg-gray-900 border-t border-gray-300 dark:border-gray-700 px-4 py-6 text-center">
        <h1 class="text-lg font-semibold text-gray-900 dark:text-white">
            📘 Sistema Web de Gestão de Ordens de Serviço
        </h1>
        <p class="text-sm mt-1 text-orange-500 font-medium">
            Projeto Tecnológico em Desenvolvimento de Sistemas
        </p>
        <div class="mt-3 text-xs text-gray-700 dark:text-gray-300">
            <p><strong class="text-gray-800 dark:text-gray-200">Marcel Fernando Finavaro</strong></p>
            <p>📧 <a href="mailto:marcelfinavaro@rede.ulbra.br" class="underline hover:text-orange-500">marcelfinavaro@rede.ulbra.br</a></p>
            <p>📞 <a href="tel:+5551993577787" class="hover:text-orange-500">(51) 99357-7787</a></p>
        </div>
    </section>

    <!-- 🔶 FOOTER -->
    <footer class="bg-gray-200 dark:bg-gray-950 text-center py-4 text-sm text-gray-700 dark:text-gray-400 border-t border-gray-300 dark:border-gray-700">
        © {{ date('Y') }} O.S Oficina. Todos os direitos reservados.
    </footer>
</div>

<!-- Alternador de Tema -->
<script>
    const toggleTheme = () => {
        const html = document.documentElement;
        const isDark = html.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    };
    document.getElementById('theme-toggle').onclick = toggleTheme;
    document.getElementById('theme-toggle-mobile').onclick = toggleTheme;
</script>

</body>
</html>
