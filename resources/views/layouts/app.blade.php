<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind + Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

       <!-- <style>
      body {
        background-image: url('/imagem/oficina-imagem2.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    } 
</style> -->

<body class="font-sans antialiased bg-gray-200 dark:bg-gray-900 text-gray-800 dark:text-gray-100">
      
    <div class="min-h-screen flex flex-col">                      
        
        
<!-- Navbar com laranja mais vivo -->
                <nav class="bg-orange-400 shadow px-6 py-4 flex justify-between items-center">
                    <div class="text-xl font-bold text-gray-800 dark:text-black flex items-center gap-2">
                        🚗 O.S OFICINA
                    </div>

                    <ul class="flex space-x-4 items-center">
                        <li>
                            <a href="{{ route('dashboard') }}"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('clientes.index') }}"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                Clientes
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('veiculos.index') }}"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                Veículos
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('ordens.index') }}"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                Ordens
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('relatorios.index') }}"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                Relatórios
                            </a>
                        </li>

                        <!-- Botão de tema -->
                        <li>
                            <button onclick="document.documentElement.classList.toggle('dark')"
                                    class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-full shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                🌗 Tema
                            </button>
                        </li>

                        <!-- Botão de logout -->
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="px-4 py-2 bg-red-500 text-white rounded-full shadow hover:bg-red-600 transition">
                                    🔓 Sair
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>                        
         
                <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mx-auto my-6 max-w-4xl text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-orange-500 mb-4">
                Organize sua oficina com mais agilidade!
            </h2>
            <p class="text-lg sm:text-xl text-gray-700 dark:text-gray-300 leading-relaxed">
                De maneira rápida e prática, você pode gerenciar suas ordens de serviço com eficiência,
                transmitindo profissionalismo e organização para seus clientes.
            </p>
        </section>        
              
           @auth
<!-- Campo de pesquisa por placa -->
            <div class="flex justify-center items-center min-h-screen">
                <form action="{{ route('veiculo.buscar') }}" method="GET"
                    class="flex flex-col items-center gap-3 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-full max-w-xs">
                    
                    <input type="text" name="placa" maxlength="8" placeholder="Digite a placa" required
                        class="w-32 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-center focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white">

                    <button type="submit"
                        class="w-32 px-3 py-2 bg-orange-500 text-white text-sm font-semibold rounded-md hover:bg-orange-600 transition">
                        🔍 Pesquisar
                    </button>
                </form>
            </div>
            @endauth
        <!-- Page Heading 
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-gray-800 dark:text-white">
                    {{ $header }}
                </div>
            </header>
        @endisset -->
        
        <!-- Page Content -->
        <main class="flex-grow px-4 py-6 bg-gray-200 dark:bg-gray-900">
            @yield('content')
        </main>
   <!-- Cabeçalho institucional do projeto (versão compacta) -->
<section class="bg-white dark:bg-gray-900 border-b border-gray-300 dark:border-gray-700 px-4 py-4 text-center shadow-sm">
    <h1 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white leading-snug">
        📘 Sistema Web de Gestão de Ordens de Serviço para Oficinas Mecânicas
    </h1>
    <p class="text-sm sm:text-base mt-1 text-orange-500 font-medium">
        Projeto Tecnológico em Desenvolvimento de Sistemas
    </p>
    <div class="mt-3 text-xs sm:text-sm text-gray-700 dark:text-gray-300 space-y-1">
        <p>👨💻 <strong class="text-gray-800 dark:text-gray-200">Marcel Fernando Finavaro</strong></p>
        <p>📧 <a href="mailto:marcelfinavaro@rede.ulbra.br" class="underline text-gray-700 dark:text-gray-300 hover:text-orange-500">marcelfinavaro@rede.ulbra.br</a></p>
        <p>📞 <a href="tel:+5551993577787" class="text-gray-700 dark:text-gray-300 hover:text-orange-500">Fone: (51) 99357-7787</a></p>
    </div>
</section>
<!-- Footer -->
<footer class="bg-white dark:bg-gray-900 text-center py-4 text-sm text-gray-600 dark:text-gray-400">
    © {{ date('Y') }} O.S Oficina. Todos os direitos reservados.
</footer>
</div>
</body>
</html>

