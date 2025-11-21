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
      
        <!-- CSS INLINE - MESMO VISUAL SEM ERROS -->
        <style>
            /* === RESET E BASE === */
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { 
                font-family: 'Figtree', Arial, sans-serif; 
                color: #1f2937;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
            
            /* === LAYOUT PRINCIPAL === */
            .min-h-screen { 
                min-height: 100vh; 
                display: flex; 
                flex-direction: column; 
                justify-content: center; 
                align-items: center; 
                padding-top: 1.5rem;
                background: #f3f4f6;
            }
            
            .dark .min-h-screen { background: #111827; }
            
            /* === RESPONSIVO === */
            @media (min-width: 640px) {
                .sm\\:justify-center { justify-content: center; }
                .sm\\:pt-0 { padding-top: 0; }
                .sm\\:max-w-md { max-width: 28rem; }
                .sm\\:rounded-lg { border-radius: 0.5rem; }
            }
            
            /* === CARD DO FORMULÁRIO === */
            .w-full { width: 100%; }
            .mt-6 { margin-top: 1.5rem; }
            .px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
            .py-4 { padding-top: 1rem; padding-bottom: 1rem; }
            
            .bg-white { background: white; }
            .dark .bg-gray-800 { background: #1f2937; }
            
            .shadow-md { 
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); 
            }
            
            .overflow-hidden { overflow: hidden; }
            
            /* === LOGO === */
            .w-20 { width: 5rem; }
            .h-20 { height: 5rem; }
            .fill-current { fill: currentColor; }
            .text-gray-500 { color: #6b7280; }
            
            /* === TEXTO === */
            .text-gray-900 { color: #1f2937; }
            .dark .text-gray-900 { color: #f9fafb; }
            
            /* === FORMULÁRIOS BÁSICOS === */
            .form-input {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #d1d5db;
                border-radius: 0.375rem;
                background: white;
                margin-bottom: 1rem;
            }
            .dark .form-input {
                background: #374151;
                border-color: #4b5563;
                color: #f9fafb;
            }
            
            .btn {
                width: 100%;
                padding: 0.75rem;
                background: #007bff;
                color: white;
                border: none;
                border-radius: 0.375rem;
                cursor: pointer;
                font-weight: 500;
            }
            .btn:hover {
                background: #0056b3;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/">
                    <!-- Logo SVG simplificado -->
                    <svg class="w-20 h-20 fill-current text-gray-500" viewBox="0 0 48 48">
                        <path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm0 36c-8.84 0-16-7.16-16-16S15.16 8 24 8s16 7.16 16 16-7.16 16-16 16z"/>
                        <path d="M24 14c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm0 16c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z"/>
                    </svg>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>