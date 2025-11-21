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
        .menu-item:hover .submenu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .submenu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
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

            <!-- Menu Navegação -->
            <nav class="flex-1 p-4 space-y-2">
                @php
                    $menuItems = [
                        [
                            'icon' => '📊',
                            'label' => 'Dashboard',
                            'route' => 'dashboard',
                            'active' => request()->routeIs('dashboard')
                        ],
                        [
                            'icon' => '👥',
                            'label' => 'Clientes',
                            'route' => 'clientes.index',
                            'active' => request()->routeIs('clientes.*'),
                            'submenu' => [
                                ['icon' => '➕', 'label' => 'Novo Cliente', 'route' => 'clientes.create'],
                                ['icon' => '📋', 'label' => 'Lista de Clientes', 'route' => 'clientes.index'],
                            ]
                        ],
                        [
                            'icon' => '🚗',
                            'label' => 'Veículos',
                            'route' => 'veiculos.index',
                            'active' => request()->routeIs('veiculos.*'),
                            'submenu' => [
                                ['icon' => '➕', 'label' => 'Novo Veículo', 'route' => 'veiculos.create'],
                                ['icon' => '📋', 'label' => 'Lista de Veículos', 'route' => 'veiculos.index'],
                            ]
                        ],
                        [
                            'icon' => '🧾',
                            'label' => 'Ordens',
                            'route' => 'ordens.index',
                            'active' => request()->routeIs('ordens.*'),
                            'submenu' => [
                                ['icon' => '➕', 'label' => 'Nova Ordem', 'route' => 'ordens.create'],
                                ['icon' => '📋', 'label' => 'Lista de Ordens', 'route' => 'ordens.index'],
                            ]
                        ],
                        [
                            'icon' => '📈',
                            'label' => 'Relatórios',
                            'route' => 'relatorios.index',
                            'active' => request()->routeIs('relatorios.*')
                        ],
                    ];
                @endphp

                @foreach ($menuItems as $item)
                    <div class="menu-item relative">
                        <a href="{{ route($item['route']) }}"
                           class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 {{ $item['active'] ? 'bg-orange-50 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400 border-r-2 border-orange-500' : '' }}">
                            <span class="text-lg">{{ $item['icon'] }}</span>
                            <span class="font-medium">{{ $item['label'] }}</span>
                            @if(isset($item['submenu']))
                                <span class="ml-auto">▼</span>
                            @endif
                        </a>

                        @if(isset($item['submenu']))
                            <div class="submenu absolute left-full top-0 ml-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-2 z-50">
                                @foreach ($item['submenu'] as $subItem)
                                    <a href="{{ route($subItem['route']) }}"
                                       class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                        <span>{{ $subItem['icon'] }}</span>
                                        <span>{{ $subItem['label'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </nav>

            <!-- Configurações e Logout -->
            <div class="p-4 border-t border-gray-200 dark:border-gray-700 space-y-2">
                <button id="theme-toggle"
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
                    <button id="mobile-menu-toggle" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <span class="text-2xl">☰</span>
                    </button>
                    
                    <div class="flex items-center space-x-2">
                        <span class="text-xl">🚗</span>
                        <h1 class="text-lg font-bold text-gray-900 dark:text-white">
                            O.S <span class="text-orange-500">Oficina</span>
                        </h1>
                    </div>

                    <button id="theme-toggle-mobile" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <span class="text-xl">🌗</span>
                    </button>
                </div>
            </header>

            <!-- MENU MOBILE -->
            <div id="mobile-menu" class="mobile-menu fixed inset-0 z-40 lg:hidden">
                <div class="fixed inset-0 bg-black bg-opacity-50" id="mobile-menu-backdrop"></div>
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
                            <button id="mobile-menu-close" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="text-xl">✕</span>
                            </button>
                        </div>
                    </div>

                    <!-- Mobile Menu Items -->
                    <nav class="p-4 space-y-2">
                        @foreach ($menuItems as $item)
                            <div class="mb-2">
                                <a href="{{ route($item['route']) }}"
                                   class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 {{ $item['active'] ? 'bg-orange-50 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400' : '' }}"
                                   onclick="closeMobileMenu()">
                                    <span class="text-lg">{{ $item['icon'] }}</span>
                                    <span class="font-medium">{{ $item['label'] }}</span>
                                </a>

                                @if(isset($item['submenu']))
                                    <div class="ml-8 mt-1 space-y-1">
                                        @foreach ($item['submenu'] as $subItem)
                                            <a href="{{ route($subItem['route']) }}"
                                               class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors duration-200"
                                               onclick="closeMobileMenu()">
                                                <span>{{ $subItem['icon'] }}</span>
                                                <span>{{ $subItem['label'] }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </nav>

                    <!-- Mobile Footer Menu -->
                    <div class="p-4 border-t border-gray-200 dark:border-gray-700 space-y-2">
                        <button onclick="toggleTheme()"
                                class="flex items-center space-x-3 w-full px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                            <span class="text-lg">🌗</span>
                            <span class="font-medium">Alternar Tema</span>
                        </button>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="flex items-center space-x-3 w-full px-4 py-3 rounded-lg text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-200"
                                    onclick="closeMobileMenu()">
                                <span class="text-lg">🚪</span>
                                <span class="font-medium">Sair</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- CONTEÚDO DA PÁGINA -->
            <main class="p-6">
                <!-- Header da Página -->
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                        @yield('page-title', 'Dashboard')
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        @yield('page-description', 'Bem-vindo ao sistema de gestão da oficina')
                    </p>
                </div>

                <!-- Conteúdo -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    @yield('content')
                </div>
            </main>

            <!-- RODAPÉ -->
            <footer class="bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 px-6 py-4">
                <div class="text-center text-sm text-gray-600 dark:text-gray-400">
                    <p>© {{ date('Y') }} O.S Oficina. Desenvolvido por Marcel Finavaro</p>
                    <p class="mt-1">📧 marcelfinavaro@rede.ulbra.br | 📞 (51) 99357-7787</p>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Toggle Mobile Menu
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('open');
        }

        function closeMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.remove('open');
        }

        // Toggle Theme
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Menu
            document.getElementById('mobile-menu-toggle').addEventListener('click', toggleMobileMenu);
            document.getElementById('mobile-menu-close').addEventListener('click', closeMobileMenu);
            document.getElementById('mobile-menu-backdrop').addEventListener('click', closeMobileMenu);

            // Theme Toggle
            document.getElementById('theme-toggle').addEventListener('click', toggleTheme);
            document.getElementById('theme-toggle-mobile').addEventListener('click', toggleTheme);

            // Close mobile menu on resize (if switching to desktop)
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    closeMobileMenu();
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>