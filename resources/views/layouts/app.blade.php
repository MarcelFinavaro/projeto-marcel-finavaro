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
        
        /* Cores para tema claro */
        :root {
            --sidebar-bg: #2c3e50;
            --main-bg: #f0f2f5;
            --card-bg: #ffffff;
            --text-primary: #2c3e50;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
        }
        
        /* Cores para tema escuro */
        .dark {
            --sidebar-bg: #1f2937;
            --main-bg: #111827;
            --card-bg: #1f2937;
            --text-primary: #f9fafb;
            --text-secondary: #d1d5db;
            --border-color: #374151;
        }
        
        .sidebar {
            background-color: var(--sidebar-bg);
            color: white;
        }
        .menu-item {
            color: #bdc3c7;
            transition: all 0.3s;
        }
        .menu-item:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
        .menu-item.active {
            background-color: #3498db;
            color: white;
        }
        .main-content {
            background-color: var(--main-bg);
        }
        .content-card {
            background-color: var(--card-bg);
            color: var(--text-primary);
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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

<body class="font-sans antialiased transition-colors duration-300">

    <div class="min-h-screen flex">

        <!-- SIDEBAR DESKTOP -->
        <aside class="w-64 sidebar border-r border-gray-600 hidden lg:flex flex-col fixed h-screen z-40">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-600">
                <div class="flex items-center space-x-3">
                    <span class="text-2xl">🚗</span>
                    <h1 class="text-xl font-bold text-white">
                        O.S <span class="text-orange-500">Oficina</span>
                    </h1>
                </div>
            </div>

            <!-- Menu Navegação -->
            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('dashboard') }}" 
                   class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="text-lg">📊</span>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('clientes.index') }}" 
                   class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                    <span class="text-lg">👥</span>
                    <span class="font-medium">Clientes</span>
                </a>

                <a href="{{ route('veiculos.index') }}" 
                   class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('veiculos.*') ? 'active' : '' }}">
                    <span class="text-lg">🚗</span>
                    <span class="font-medium">Veículos</span>
                </a>

                <a href="{{ route('ordens.index') }}" 
                   class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('ordens.*') ? 'active' : '' }}">
                    <span class="text-lg">🧾</span>
                    <span class="font-medium">Ordens</span>
                </a>

                <a href="{{ route('relatorios.index') }}" 
                   class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('relatorios.*') ? 'active' : '' }}">
                    <span class="text-lg">📈</span>
                    <span class="font-medium">Relatórios</span>
                </a>
            </nav>

            <!-- Configurações e Logout -->
            <div class="p-4 border-t border-gray-600 space-y-2">
                <button onclick="toggleTheme()"
                        class="menu-item flex items-center space-x-3 w-full px-4 py-3 rounded-lg transition-colors duration-200">
                    <span class="text-lg">🌗</span>
                    <span class="font-medium">Alternar Tema</span>
                </button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="menu-item flex items-center space-x-3 w-full px-4 py-3 rounded-lg transition-colors duration-200">
                        <span class="text-lg">🚪</span>
                        <span class="font-medium">Sair</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- CONTEÚDO PRINCIPAL -->
        <div class="flex-1 lg:ml-64 main-content">
            <!-- HEADER MOBILE -->
            <header class="content-card border-b border-gray-300 dark:border-gray-600 lg:hidden sticky top-0 z-30">
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
                <div class="fixed top-0 left-0 bottom-0 w-80 sidebar shadow-xl overflow-y-auto">
                    <!-- Header Mobile Menu -->
                    <div class="p-6 border-b border-gray-600">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <span class="text-2xl">🚗</span>
                                <h1 class="text-xl font-bold text-white">
                                    O.S <span class="text-orange-500">Oficina</span>
                                </h1>
                            </div>
                            <button onclick="toggleMobileMenu()" class="p-2 rounded-lg hover:bg-gray-700">
                                <span class="text-xl text-white">✕</span>
                            </button>
                        </div>
                    </div>

                    <!-- Mobile Menu Items -->
                    <nav class="p-4 space-y-1">
                        <a href="{{ route('dashboard') }}" 
                           class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                           onclick="toggleMobileMenu()">
                            <span class="text-lg">📊</span>
                            <span class="font-medium">Dashboard</span>
                        </a>

                        <a href="{{ route('clientes.index') }}" 
                           class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('clientes.*') ? 'active' : '' }}"
                           onclick="toggleMobileMenu()">
                            <span class="text-lg">👥</span>
                            <span class="font-medium">Clientes</span>
                        </a>

                        <a href="{{ route('veiculos.index') }}" 
                           class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('veiculos.*') ? 'active' : '' }}"
                           onclick="toggleMobileMenu()">
                            <span class="text-lg">🚗</span>
                            <span class="font-medium">Veículos</span>
                        </a>

                        <a href="{{ route('ordens.index') }}" 
                           class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('ordens.*') ? 'active' : '' }}"
                           onclick="toggleMobileMenu()">
                            <span class="text-lg">🧾</span>
                            <span class="font-medium">Ordens</span>
                        </a>

                        <a href="{{ route('relatorios.index') }}" 
                           class="menu-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('relatorios.*') ? 'active' : '' }}"
                           onclick="toggleMobileMenu()">
                            <span class="text-lg">📈</span>
                            <span class="font-medium">Relatórios</span>
                        </a>
                    </nav>

                    <!-- Mobile Footer Menu -->
                    <div class="p-4 border-t border-gray-600 space-y-2">
                        <button onclick="toggleTheme(); toggleMobileMenu();"
                                class="menu-item flex items-center space-x-3 w-full px-4 py-3 rounded-lg transition-colors duration-200">
                            <span class="text-lg">🌗</span>
                            <span class="font-medium">Alternar Tema</span>
                        </button>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="menu-item flex items-center space-x-3 w-full px-4 py-3 rounded-lg transition-colors duration-200"
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
                <div class="content-card border-b border-gray-300 dark:border-gray-600 px-6 py-4">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                        @yield('page-title', 'Dashboard')
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        @yield('page-description', 'Bem-vindo ao sistema de gestão da oficina')
                    </p>
                </div>

                <!-- Área de Conteúdo -->
                <div class="flex-1 p-6">
                   <!-- Guia do Sistema (apenas no dashboard) -->
                    @if(request()->routeIs('dashboard'))
                    <div class="max-w-6xl mx-auto mb-8 content-card rounded-xl shadow-xl p-4 md:p-8">
                        <div class="text-center mb-6">
                            <h2 class="text-xl md:text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mb-2">🚀 Bem-vindo ao O.S Oficina</h2>
                            <p class="text-sm md:text-base text-gray-600 dark:text-gray-400">Sistema Web de Gestão de Ordens de Serviço</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 mb-6">
                            <!-- Passo 1 -->
                            <div class="bg-blue-50 dark:bg-blue-900/20 p-3 md:p-4 rounded-lg border border-blue-200 dark:border-blue-800">
                                <div class="text-xl md:text-2xl mb-2">👥</div>
                                <h3 class="font-semibold text-blue-800 dark:text-blue-300 mb-1 text-sm md:text-base">1. Cadastre Clientes</h3>
                                <p class="text-xs md:text-sm text-blue-600 dark:text-blue-400">Registre os dados dos clientes</p>
                            </div>

                            <!-- Passo 2 -->
                            <div class="bg-green-50 dark:bg-green-900/20 p-3 md:p-4 rounded-lg border border-green-200 dark:border-green-800">
                                <div class="text-xl md:text-2xl mb-2">🚗</div>
                                <h3 class="font-semibold text-green-800 dark:text-green-300 mb-1 text-sm md:text-base">2. Adicione Veículos</h3>
                                <p class="text-xs md:text-sm text-green-600 dark:text-green-400">Vincule veículos aos clientes</p>
                            </div>

                            <!-- Passo 3 -->
                            <div class="bg-orange-50 dark:bg-orange-900/20 p-3 md:p-4 rounded-lg border border-orange-200 dark:border-orange-800">
                                <div class="text-xl md:text-2xl mb-2">🧾</div>
                                <h3 class="font-semibold text-orange-800 dark:text-orange-300 mb-1 text-sm md:text-base">3. Crie O.S</h3>
                                <p class="text-xs md:text-sm text-orange-600 dark:text-orange-400">Registre serviços e peças</p>
                            </div>

                            <!-- Passo 4 -->
                            <div class="bg-purple-50 dark:bg-purple-900/20 p-3 md:p-4 rounded-lg border border-purple-200 dark:border-purple-800">
                                <div class="text-xl md:text-2xl mb-2">📊</div>
                                <h3 class="font-semibold text-purple-800 dark:text-purple-300 mb-1 text-sm md:text-base">4. Relatórios PDF</h3>
                                <p class="text-xs md:text-sm text-purple-600 dark:text-purple-400">Exporte para assinatura</p>
                            </div>
                        </div>

                        <!-- Benefícios -->
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3 md:p-4">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2 md:mb-3 text-sm md:text-base">🎯 Benefícios do Sistema:</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 md:gap-3 text-xs md:text-sm">
                                <div class="flex items-center space-x-2">
                                    <span class="text-green-500 text-sm">✓</span>
                                    <span class="text-gray-700 dark:text-gray-300">Cálculo automático de valores</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-green-500 text-sm">✓</span>
                                    <span class="text-gray-700 dark:text-gray-300">Histórico completo por veículo</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-green-500 text-sm">✓</span>
                                    <span class="text-gray-700 dark:text-gray-300">Relatórios profissionais em PDF</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-green-500 text-sm">✓</span>
                                    <span class="text-gray-700 dark:text-gray-300">Organização total dos registros</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Conteúdo Dinâmico -->
                    <div class="content-card p-6">
                        @yield('content')
                    </div>
                </div>

                <!-- RODAPÉ INSTITUCIONAL -->
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
                <footer class="bg-gray-200 dark:bg-gray-800 text-center py-4 text-sm text-gray-700 dark:text-gray-400 border-t border-gray-300 dark:border-gray-700">
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

        // Toggle Theme (CORRIGIDO E FUNCIONAL)
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