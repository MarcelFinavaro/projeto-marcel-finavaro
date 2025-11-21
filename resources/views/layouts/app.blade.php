<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- CSS INLINE - MESMO VISUAL SEM ERROS -->
    <style>
        /* === RESET E BASE === */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Figtree', Arial, sans-serif; 
            background: #f3f4f6; 
            color: #1f2937;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* === TEMA ESCURO === */
        .dark { background: #030712; color: #f9fafb; }
        .dark body { background: #030712; color: #f9fafb; }
        
        /* === NAVBAR === */
        nav { 
            background: rgba(229, 231, 235, 0.9); 
            backdrop-filter: blur(8px);
            border-bottom: 1px solid #d1d5db;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .dark nav { 
            background: rgba(31, 41, 55, 0.8); 
            border-color: #374151; 
        }
        
        /* === CONTAINERS === */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }
        .max-w-7xl { max-width: 80rem; }
        .max-w-4xl { max-width: 56rem; }
        .max-w-md { max-width: 28rem; }
        
        /* === FLEXBOX === */
        .flex { display: flex; }
        .flex-col { flex-direction: column; }
        .justify-between { justify-content: space-between; }
        .justify-center { justify-content: center; }
        .items-center { align-items: center; }
        .flex-grow { flex-grow: 1; }
        
        /* === SPACING === */
        .space-x-2 > * + * { margin-left: 0.5rem; }
        .space-x-3 > * + * { margin-left: 0.75rem; }
        .space-y-1 > * + * { margin-top: 0.25rem; }
        .px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .py-4 { padding-top: 1rem; padding-bottom: 1rem; }
        .py-3 { padding-top: 0.75rem; padding-bottom: 0.75rem; }
        .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
        .p-8 { padding: 2rem; }
        .p-6 { padding: 1.5rem; }
        .mt-10 { margin-top: 2.5rem; }
        .mt-6 { margin-top: 1.5rem; }
        .mt-3 { margin-top: 0.75rem; }
        .mt-1 { margin-top: 0.25rem; }
        .mb-6 { margin-bottom: 1.5rem; }
        .mb-4 { margin-bottom: 1rem; }
        
        /* === TEXT === */
        .text-3xl { font-size: 1.875rem; line-height: 2.25rem; }
        .text-2xl { font-size: 1.5rem; line-height: 2rem; }
        .text-xl { font-size: 1.25rem; line-height: 1.75rem; }
        .text-lg { font-size: 1.125rem; line-height: 1.75rem; }
        .text-sm { font-size: 0.875rem; line-height: 1.25rem; }
        .text-xs { font-size: 0.75rem; line-height: 1rem; }
        
        .font-bold { font-weight: 700; }
        .font-semibold { font-weight: 600; }
        .font-medium { font-weight: 500; }
        
        .text-gray-900 { color: #1f2937; }
        .text-white { color: #ffffff; }
        .text-orange-500 { color: #f97316; }
        .text-gray-700 { color: #374151; }
        .text-gray-500 { color: #6b7280; }
        .text-gray-400 { color: #9ca3af; }
        .text-gray-300 { color: #d1d5db; }
        
        .dark .text-gray-900 { color: #f9fafb; }
        .dark .text-gray-700 { color: #d1d5db; }
        .dark .text-gray-500 { color: #9ca3af; }
        .dark .text-gray-400 { color: #6b7280; }
        .dark .text-gray-300 { color: #4b5563; }
        
        .tracking-tight { letter-spacing: -0.025em; }
        .tracking-wide { letter-spacing: 0.025em; }
        .leading-relaxed { line-height: 1.625; }
        
        /* === BACKGROUNDS === */
        .bg-gray-100 { background: #f3f4f6; }
        .bg-gray-200 { background: #e5e7eb; }
        .bg-gray-300 { background: #d1d5db; }
        .bg-white { background: #ffffff; }
        .bg-orange-500 { background: #f97316; }
        .bg-red-500 { background: #ef4444; }
        
        .dark .bg-gray-800 { background: #1f2937; }
        .dark .bg-gray-700 { background: #374151; }
        .dark .bg-gray-600 { background: #4b5563; }
        .dark .bg-gray-900 { background: #111827; }
        .dark .bg-gray-950 { background: #030712; }
        
        /* === OPACITY BACKGROUNDS === */
        .bg-gray-200\\/80 { background: rgba(229, 231, 235, 0.8); }
        .bg-white\\/90 { background: rgba(255, 255, 255, 0.9); }
        .dark .bg-gray-800\\/70 { background: rgba(31, 41, 55, 0.7); }
        .dark .bg-gray-800\\/80 { background: rgba(31, 41, 55, 0.8); }
        
        /* === BORDERS === */
        .border { border-width: 1px; }
        .border-b { border-bottom-width: 1px; }
        .border-t { border-top-width: 1px; }
        .border-gray-300 { border-color: #d1d5db; }
        .border-gray-200 { border-color: #e5e7eb; }
        .dark .border-gray-700 { border-color: #374151; }
        
        /* === BORDER RADIUS === */
        .rounded-full { border-radius: 9999px; }
        .rounded-xl { border-radius: 0.75rem; }
        .rounded-2xl { border-radius: 1rem; }
        .rounded-lg { border-radius: 0.5rem; }
        
        /* === SHADOWS === */
        .shadow-md { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
        .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
        .shadow-xl { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
        .shadow-sm { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
        .shadow-inner { box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06); }
        
        /* === EFFECTS === */
        .backdrop-blur-md { backdrop-filter: blur(12px); }
        .sticky { position: sticky; }
        .top-0 { top: 0; }
        .z-50 { z-index: 50; }
        
        /* === INTERACTIVITY === */
        .cursor-pointer { cursor: pointer; }
        
        /* === TRANSITIONS === */
        .transition { transition: all 0.15s ease; }
        .transition-all { transition: all 0.3s ease; }
        .transition-colors { transition: color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease; }
        .duration-300 { transition-duration: 0.3s; }
        .duration-500 { transition-duration: 0.5s; }
        
        /* === STATES === */
        .hover\\:bg-orange-600:hover { background: #ea580c; }
        .hover\\:bg-red-600:hover { background: #dc2626; }
        .hover\\:bg-gray-400:hover { background: #9ca3af; }
        .dark .hover\\:bg-gray-500:hover { background: #6b7280; }
        .hover\\:text-white:hover { color: #ffffff; }
        .hover\\:text-orange-500:hover { color: #f97316; }
        
        .active\\:scale-95:active { transform: scale(0.95); }
        
        .focus-within\\:ring-2:focus-within { box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.5); }
        .focus-within\\:ring-orange-500:focus-within { --ring-color: #f97316; }
        
        .focus\\:outline-none:focus { outline: none; }
        
        /* === FORMS === */
        input, button, textarea, select { 
            font-family: inherit; 
            font-size: inherit; 
        }
        input::placeholder { color: #9ca3af; }
        .dark input::placeholder { color: #6b7280; }
        
        /* === GRID === */
        .gap-5 { gap: 1.25rem; }
        .gap-3 { gap: 0.75rem; }
        
        /* === RESPONSIVE === */
        .sm\\:justify-center { @media (min-width: 640px) { justify-content: center; } }
        .sm\\:pt-0 { @media (min-width: 640px) { padding-top: 0; } }
        .sm\\:max-w-md { @media (min-width: 640px) { max-width: 28rem; } }
        .sm\\:rounded-lg { @media (min-width: 640px) { border-radius: 0.5rem; } }
        .sm\\:text-xl { @media (min-width: 640px) { font-size: 1.25rem; line-height: 1.75rem; } }
        .sm\\:text-base { @media (min-width: 640px) { font-size: 1rem; line-height: 1.5rem; } }
        .sm\\:text-sm { @media (min-width: 640px) { font-size: 0.875rem; line-height: 1.25rem; } }
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