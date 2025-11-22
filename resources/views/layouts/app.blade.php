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

    <!-- Tema carregado antes do conteúdo -->
    <script>
        (function () {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-500">

<div class="min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <nav class="backdrop-blur-md bg-white/80 dark:bg-gray-800/70 border-b border-gray-300 dark:border-gray-700 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <!-- LOGO -->
            <div class="flex items-center space-x-2">
                <span class="text-2xl">🔧</span>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white tracking-tight">
                    O.S <span class="text-orange-500">Oficina</span>
                </h1>
            </div>

            <!-- MENU DESKTOP -->
            <ul class="hidden md:flex space-x-3 items-center">

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
                           class="px-4 py-2 rounded-lg border border-gray-400 dark:border-gray-600
                                  bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100
                                  hover:bg-orange-500 hover:text-white hover:border-orange-500
                                  transition-all duration-300 shadow-sm">
                            {{ $label }}
                        </a>
                    </li>
                @endforeach

                <!-- BOTÃO TEMA -->
                <li>
                    <button id="themeToggle"
                        class="px-4 py-2 rounded-lg border border-gray-400 dark:border-gray-600
                               bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100
                               hover:bg-orange-500 hover:text-white hover:border-orange-500
                               transition-all duration-300 shadow-sm">
                        🌗 Tema
                    </button>
                </li>

                <!-- LOGOUT -->
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 rounded-lg bg-red-500 text-white font-semibold
                                   hover:bg-red-600 transition-all duration-300 shadow-md">
                            🔓 Sair
                        </button>
                    </form>
                </li>
            </ul>

            <!-- BOTÃO MOBILE -->
            <button data-dropdown-toggle="menuMobile"
                class="md:hidden px-3 py-2 bg-gray-300 dark:bg-gray-700 rounded-lg text-gray-800 dark:text-gray-100">
                ☰
            </button>
        </div>

        <!-- MENU MOBILE -->
        <div id="menuMobile" class="hidden md:hidden px-6 pb-4 space-y-3">

            @foreach ($links as [$label, $url])
                <a href="{{ $url }}"
                   class="block px-4 py-3 rounded-lg border border-gray-400 dark:border-gray-600
                          bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100
                          hover:bg-orange-500 hover:text-white hover:border-orange-500
                          transition-all duration-300 shadow-sm">
                    {{ $label }}
                </a>
            @endforeach

            <!-- TEMA MOBILE -->
            <button id="themeToggleMobile"
                class="w-full px-4 py-3 rounded-lg border border-gray-400 dark:border-gray-600
                       bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100
                       hover:bg-orange-500 hover:text-white hover:border-orange-500
                       transition-all duration-300 shadow-sm">
                🌗 Tema
            </button>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full px-4 py-3 rounded-lg bg-red-500 text-white font-semibold hover:bg-red-600 transition-all duration-300">
                    🔓 Sair
                </button>
            </form>

        </div>
    </nav>

    <!-- TEXTO DA PÁGINA PRINCIPAL APENAS NO DASHBOARD -->
    @if (Route::is('dashboard'))
        <section class="max-w-4xl mx-auto mt-10 bg-white/90 dark:bg-gray-800/80 rounded-xl shadow-xl p-8 text-center backdrop-blur-md">
            <h2 class="text-3xl font-bold text-orange-500 mb-4">
                Organize sua oficina com mais eficiência!
            </h2>
            <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                Gerencie ordens de serviço, clientes e veículos de forma rápida e profissional,
                mantendo o controle total das atividades da sua oficina.
            </p>
        </section>
    @endif


    <!-- CONTEÚDO PRINCIPAL -->
    <main class="flex-grow px-6 py-8">
        @yield('content')
    </main>

    <!-- RODAPÉ -->
    <footer class="bg-gray-200 dark:bg-gray-950 text-center py-6 text-sm text-gray-700 dark:text-gray-400 border-t border-gray-300 dark:border-gray-700">
        <h1 class="text-lg font-semibold text-gray-900 dark:text-white">
            📘 Sistema Web de Gestão de Ordens de Serviço
        </h1>
        <p class="text-orange-500 font-medium">Projeto Tecnológico em Desenvolvimento de Sistemas</p>
        <p class="mt-2">👨💻 <strong>Marcel Fernando Finavaro</strong></p>
        <p>📧 <a href="mailto:marcelfinavaro@rede.ulbra.br" class="underline hover:text-orange-500">marcelfinavaro@rede.ulbra.br</a></p>
        <p>📞 <a href="tel:+5551993577787" class="hover:text-orange-500">(51) 99357-7787</a></p>
        <div class="mt-4">© {{ date('Y') }} O.S Oficina. Todos os direitos reservados.</div>
    </footer>

</div>

</body>
</html>
