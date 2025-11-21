<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'O.S Oficina')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        .mobile-menu.open {
            transform: translateX(0);
        }
        
        /* Estilo do menu lateral */
        .menu-item.active {
            background-color: #fed7aa;
            border-right: 3px solid #f97316;
        }
        .dark .menu-item.active {
            background-color: #7c2d12;
            border-right: 3px solid #fdba74;
        }
    </style>

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

<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">

    <div class="min-h-screen flex">

        <!-- SIDEBAR DESKTOP -->
        <aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 hidden lg:flex flex-col fixed h-screen z-40">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-3">
                    <span class="text-2xl">🚗</span>
                    <h1 class="text-xl font-bold text-gray-900 dark:text-white">
                        O.S <span class="text-orange-500">Oficina</span>
                    </h1>
                </div>
            </div>

            <!-- Menu Navegação Simples -->
            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('dashboard') }}" 
                   class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="text-lg">📊</span>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('clientes.index') }}" 
                   class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                    <span class="text-lg">👥</span>
                    <span class="font-medium">Clientes</span>
                </a>

                <a href="{{ route('veiculos.index') }}" 
                   class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('veiculos.*') ? 'active' : '' }}">
                    <span class="text-lg">🚗</span>
                    <span class="font-medium">Veículos</span>
                </a>

                <a href="{{ route('ordens.index') }}" 
                   class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('ordens.*') ? 'active' : '' }}">
                    <span class="text-lg">🧾</span>
                    <span class="font-medium">Ordens</span>
                </a>

                <a href="{{ route('relatorios.index') }}" 
                   class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('relatorios.*') ? 'active' : '' }}">
                    <span class="text-lg">📈</span>
                    <span class="font-medium">Relatórios</span>
                </a>
            </nav>

            <!-- Configurações e Logout -->
            <div class="p-4 border-t border-gray-200 dark:border-gray-700 space-y-2">
                <button onclick="toggleTheme()"
                        class="flex items-center space-x-3 w-full px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                    <span class="text-lg">🌗</span>
                    <span class="font-medium">Alternar Tema</span>
                </button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="flex items-center space-x-3 w-full px-4 py-3 rounded-lg text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-200">
                        <span class="text-lg">🚪</span>
                        <span class="font-medium">Sair</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- CONTEÚDO PRINCIPAL -->
        <div class="flex-1 lg:ml-64">
            <!-- HEADER MOBILE -->
            <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 lg:hidden sticky top-0 z-30">
                <div class="flex items-center justify-between p-4">
                    <button onclick="toggleMobileMenu()" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <span class="text-2xl">☰</span>
                    </button>
                    
                    <div class="flex items-center space-x-2">
                        <span class="text-xl">🚗</span>
                        <h1 class="text-lg font-bold text-gray-900 dark:text-white">
                            O.S <span class="text-orange-500">Oficina</span>
                        </h1>
                    </div>

                    <button onclick="toggleTheme()" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <span class="text-xl">🌗</span>
                    </button>
                </div>
            </header>

            <!-- MENU MOBILE -->
            <div id="mobile-menu" class="mobile-menu fixed inset-0 z-40 lg:hidden">
                <div class="fixed inset-0 bg-black bg-opacity-50" onclick="toggleMobileMenu()"></div>
                <div class="fixed top-0 left-0 bottom-0 w-80 bg-white dark:bg-gray-800 shadow-xl overflow-y-auto">
                    <!-- Header Mobile Menu -->
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <span class="text-2xl">🚗</span>
                                <h1 class="text-xl font-bold text-gray-900 dark:text-white">
                                    O.S <span class="text-orange-500">Oficina</span>
                                </h1>
                            </div>
                            <button onclick="toggleMobileMenu()" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="text-xl">✕</span>
                            </button>
                        </div>
                    </div>

                    <!-- Mobile Menu Items -->
                    <nav class="p-4 space-y-1">
                        <a href="{{ route('dashboard') }}" 
                           class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                           onclick="toggleMobileMenu()">
                            <span class="text-lg">📊</span>
                            <span class="font-medium">Dashboard</span>
                        </a>

                        <a href="{{ route('clientes.index') }}" 
                           class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('clientes.*') ? 'active' : '' }}"
                           onclick="toggleMobileMenu()">
                            <span class="text-lg">👥</span>
                            <span class="font-medium">Clientes</span>
                        </a>

                        <a href="{{ route('veiculos.index') }}" 
                           class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('veiculos.*') ? 'active' : '' }}"
                           onclick="toggleMobileMenu()">
                            <span class="text-lg">🚗</span>
                            <span class="font-medium">Veículos</span>
                        </a>

                        <a href="{{ route('ordens.index') }}" 
                           class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('ordens.*') ? 'active' : '' }}"
                           onclick="toggleMobileMenu()">
                            <span class="text-lg">🧾</span>
                            <span class="font-medium">Ordens</span>
                        </a>

                        <a href="{{ route('relatorios.index') }}" 
                           class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('relatorios.*') ? 'active' : '' }}"
                           onclick="toggleMobileMenu()">
                            <span class="text-lg">📈</span>
                            <span class="font-medium">Relatórios</span>
                        </a>
                    </nav>

                    <!-- Mobile Footer Menu -->
                    <div class="p-4 border-t border-gray-200 dark:border-gray-700 space-y-2">
                        <button onclick="toggleTheme(); toggleMobileMenu();"
                                class="flex items-center space-x-3 w-full px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                            <span class="text-lg">🌗</span>
                            <span class="font-medium">Alternar Tema</span>
                        </button>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="flex items-center space-x-3 w-full px-4 py-3 rounded-lg text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-200"
                                    onclick="toggleMobileMenu()">
                                <span class="text-lg">🚪</span>
                                <span class="font-medium">Sair</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- CONTEÚDO DA PÁGINA -->
            <main class="min-h-screen flex flex-col">
                <!-- Header da Página -->
                <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                        @yield('page-title', 'Dashboard')
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        @yield('page-description', 'Bem-vindo ao sistema de gestão da oficina')
                    </p>
                </div>

                <!-- Área de Conteúdo -->
                <div class="flex-1 p-6">
                    <!-- Seção de Apresentação (apenas no dashboard) -->
                    @if(request()->routeIs('dashboard'))
                    <section class="max-w-4xl mx-auto mb-8 bg-white/90 dark:bg-gray-800/80 rounded-xl shadow-xl p-8 text-center backdrop-blur-md">
                        <h2 class="text-3xl font-bold text-orange-500 mb-4">
                            Organize sua oficina com mais agilidade!
                        </h2>
                        <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                            Gerencie ordens de serviço com eficiência e profissionalismo, 
                            oferecendo uma experiência moderna e organizada aos seus clientes.
                        </p>
                    </section>
                    @endif

                    <!-- Conteúdo Dinâmico -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        @yield('content')
                    </div>
                </div>

                <!-- RODAPÉ INSTITUCIONAL COMPLETO -->
                <section class="bg-gray-100 dark:bg-gray-900 border-t border-gray-300 dark:border-gray-700 px-4 py-6 text-center">
                    <h1 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white">
                        📘 Sistema Web de Gestão de Ordens de Serviço
                    </h1>
                    <p class="text-sm sm:text-base mt-1 text-orange-500 font-medium">
                        Projeto Tecnológico em Desenvolvimento de Sistemas
                    </p>
                    <div class="mt-3 text-xs sm:text-sm text-gray-700 dark:text-gray-300 space-y-1">
                        <p>👨‍💻 <strong class="text-gray-800 dark:text-gray-200">Marcel Fernando Finavaro</strong></p>
                        <p>📧 <a href="mailto:marcelfinavaro@rede.ulbra.br" class="underline hover:text-orange-500">marcelfinavaro@rede.ulbra.br</a></p>
                        <p>📞 <a href="tel:+5551993577787" class="hover:text-orange-500">Fone: (51) 99357-7787</a></p>
                    </div>
                </section>

                <!-- FOOTER -->
                <footer class="bg-gray-200 dark:bg-gray-950 text-center py-4 text-sm text-gray-700 dark:text-gray-400 border-t border-gray-300 dark:border-gray-700">
                    © {{ date('Y') }} O.S Oficina. Todos os direitos reservados.
                </footer>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Toggle Mobile Menu
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('open');
        }

        // Toggle Theme (CORRIGIDO)
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }

        // Fechar menu mobile ao redimensionar para desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                const menu = document.getElementById('mobile-menu');
                menu.classList.remove('open');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>