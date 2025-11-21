<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- CSS INLINE CORRIGIDO -->
    <style>
        /* Reset e base */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Figtree', Arial, sans-serif; 
            background: #f3f4f6; 
            color: #1f2937;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Tema escuro */
        .dark body { background: #111827; color: #f9fafb; }
        
        /* Navbar */
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
        
        /* Container */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }
        
        /* Flex utilities */
        .flex { display: flex; }
        .flex-col { flex-direction: column; }
        .justify-between { justify-content: space-between; }
        .items-center { align-items: center; }
        .flex-grow { flex-grow: 1; }
        
        /* Spacing */
        .space-x-2 > * + * { margin-left: 0.5rem; }
        .space-x-3 > * + * { margin-left: 0.75rem; }
        .px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
        .py-4 { padding-top: 1rem; padding-bottom: 1rem; }
        .mt-10 { margin-top: 2.5rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mb-6 { margin-bottom: 1.5rem; }
        
        /* Text */
        .text-2xl { font-size: 1.5rem; }
        .text-xl { font-size: 1.25rem; }
        .text-3xl { font-size: 1.875rem; }
        .text-lg { font-size: 1.125rem; }
        .text-sm { font-size: 0.875rem; }
        .text-xs { font-size: 0.75rem; }
        
        .font-bold { font-weight: 700; }
        .font-semibold { font-weight: 600; }
        .font-medium { font-weight: 500; }
        
        .text-gray-900 { color: #1f2937; }
        .text-white { color: #ffffff; }
        .text-orange-500 { color: #f97316; }
        .text-gray-700 { color: #374151; }
        .text-gray-500 { color: #6b7280; }
        
        .dark .text-gray-900 { color: #f9fafb; }
        .dark .text-gray-700 { color: #d1d5db; }
        .dark .text-gray-500 { color: #9ca3af; }
        
        /* Cards e containers */
        .card { 
            background: white; 
            border-radius: 12px; 
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: 2.5rem auto;
            max-width: 32rem;
            width: 100%;
            text-align: center;
        }
        .dark .card { background: #1f2937; }
        
        /* Buttons */
        .btn { 
            padding: 0.75rem 1.5rem; 
            border-radius: 9999px; 
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-orange { 
            background: #f97316; 
            color: white; 
        }
        .btn-orange:hover { background: #ea580c; }
        
        .btn-gray { 
            background: #d1d5db; 
            color: #1f2937; 
        }
        .dark .btn-gray { 
            background: #4b5563; 
            color: #f9fafb; 
        }
        .btn-gray:hover { background: #9ca3af; }
        
        .btn-red { 
            background: #ef4444; 
            color: white; 
        }
        .btn-red:hover { background: #dc2626; }
        
        /* Forms */
        .form-input {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 9999px;
            width: 100%;
            background: #f9fafb;
            text-align: center;
            margin-bottom: 1rem;
        }
        .dark .form-input {
            background: #374151;
            border-color: #4b5563;
            color: #f9fafb;
        }
        .form-input:focus {
            outline: none;
            border-color: #f97316;
            box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.2);
        }
        
        /* Main content */
        main { 
            flex-grow: 1; 
            padding: 0 1.5rem 2rem; 
        }
        
        /* Footer */
        footer { 
            background: #e5e7eb; 
            text-align: center; 
            padding: 1rem; 
            border-top: 1px solid #d1d5db;
        }
        .dark footer { 
            background: #030712; 
            border-color: #374151; 
            color: #9ca3af;
        }
        
        /* Utilities */
        .text-center { text-align: center; }
        .w-20 { width: 5rem; }
        .h-20 { height: 5rem; }
        .leading-relaxed { line-height: 1.625; }
        .shadow-md { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        .rounded-full { border-radius: 9999px; }
        .rounded-xl { border-radius: 0.75rem; }
        .backdrop-blur-md { backdrop-filter: blur(12px); }
        
        /* Grid e layout */
        .grid { display: grid; }
        .gap-5 { gap: 1.25rem; }
        .gap-3 { gap: 0.75rem; }
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

<body>

    <div class="min-h-screen flex flex-col">

        <!-- NAVBAR CORRIGIDA -->
        <nav>
            <div class="container flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <span class="text-2xl">🚗</span>
                    <h1 class="text-xl font-bold text-gray-900 dark:text-white">
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
                            <a href="{{ $url }}" class="btn btn-gray">
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach

                    <li>
                        <button id="theme-toggle" class="btn btn-gray">
                            🌗 Tema
                        </button>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-red">
                                🔓 Sair
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- SEÇÃO DE APRESENTAÇÃO -->
        <section class="card">
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
            <div class="card">
                
               {{-- ===== CLIENTES ===== --}}
                @if (Route::is('clientes.index'))
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">👤 Clientes</h3>

                    <div class="flex justify-center">
                        <a href="{{ route('clientes.create') }}" class="btn btn-orange">
                            ➕ Cadastrar Novo Cliente
                        </a>
                    </div>

                {{-- ===== VEÍCULOS ===== --}}
                @elseif (Route::is('veiculos.index'))
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">🚘 Buscar Veículo</h3>
                    <form action="{{ route('veiculos.index') }}" method="GET" class="flex flex-col gap-5">
                        <div class="flex items-center form-input">
                            <span class="text-gray-400 dark:text-gray-300 mr-2">🔤</span>
                            <input type="text" name="placa" maxlength="8" placeholder="Digite a placa (ex: ABC1D23)"
                                class="flex-grow bg-transparent focus:outline-none text-center text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 text-sm">
                        </div>
                        <div class="flex justify-center gap-3">
                            <a href="{{ route('veiculos.create') }}" class="btn btn-orange">
                                ➕ Novo Veículo
                            </a>
                            <button type="submit" class="btn btn-gray">
                                Pesquisar 🔎
                            </button>
                        </div>
                    </form>

                {{-- ===== ORDENS ===== --}}
                @elseif (Route::is('ordens.index'))
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">🧾 Ordens de Serviço</h3>
                    <form action="{{ route('ordens.index') }}" method="GET" class="flex flex-col gap-5">
                        <div class="flex items-center form-input">
                            <span class="text-gray-400 dark:text-gray-300 mr-2">🔎</span>
                            <input type="text" name="ordem" placeholder="Buscar por número ou cliente"
                                class="flex-grow bg-transparent focus:outline-none text-center text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 text-sm">
                        </div>
                        <div class="flex justify-center gap-3">
                            <a href="{{ route('ordens.create') }}" class="btn btn-orange">
                                ➕ Nova Ordem
                            </a>
                            <button type="submit" class="btn btn-gray">
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
        <main>
            @yield('content')
        </main>

        <!-- RODAPÉ INSTITUCIONAL -->
        <section class="card text-center">
            <h1 class="text-xl font-semibold text-gray-900 dark:text-white">
                📘 Sistema Web de Gestão de Ordens de Serviço
            </h1>
            <p class="text-base mt-1 text-orange-500 font-medium">
                Projeto Tecnológico em Desenvolvimento de Sistemas
            </p>
            <div class="mt-3 text-sm text-gray-700 dark:text-gray-300 space-y-1">
                <p>👨💻 <strong class="text-gray-800 dark:text-gray-200">Marcel Fernando Finavaro</strong></p>
                <p>📧 <a href="mailto:marcelfinavaro@rede.ulbra.br" class="underline hover:text-orange-500">marcelfinavaro@rede.ulbra.br</a></p>
                <p>📞 <a href="tel:+5551993577787" class="hover:text-orange-500">Fone: (51) 99357-7787</a></p>
            </div>
        </section>

        <!-- FOOTER -->
        <footer>
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