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
      
        <!-- Styles -->
        <style>
            body { 
                font-family: 'Figtree', Arial, sans-serif; 
                margin: 0; 
                padding: 0; 
                background: #f8fafc; 
                color: #374151;
            }
            .min-h-screen { 
                min-height: 100vh; 
                display: flex; 
                flex-direction: column; 
                justify-content: center; 
                align-items: center; 
                padding: 1.5rem 0; 
            }
            .card { 
                background: white; 
                padding: 2rem; 
                border-radius: 10px; 
                box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
                width: 100%; 
                max-width: 400px; 
                margin: 1.5rem auto; 
            }
            .btn { 
                padding: 12px 24px; 
                background: #007bff; 
                color: white; 
                border: none; 
                border-radius: 6px; 
                width: 100%; 
                cursor: pointer; 
                font-size: 16px;
                font-weight: 500;
            }
            .btn:hover { 
                background: #0056b3; 
            }
            .form-input { 
                padding: 12px; 
                border: 1px solid #d1d5db; 
                border-radius: 6px; 
                width: 100%; 
                margin-bottom: 1rem; 
                font-size: 16px;
                box-sizing: border-box;
            }
            .form-input:focus { 
                border-color: #007bff; 
                outline: none; 
                box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
            }
            .text-gray-500 { color: #6b7280; }
            .w-20 { width: 5rem; }
            .h-20 { height: 5rem; }
            .fill-current { fill: currentColor; }
        </style>
    </head>
    <body>
        <div class="min-h-screen">
            <div>
                <a href="/">
                    <!-- Logo simplificado -->
                    <svg class="w-20 h-20 fill-current text-gray-500" viewBox="0 0 48 48">
                        <path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm0 36c-8.84 0-16-7.16-16-16S15.16 8 24 8s16 7.16 16 16-7.16 16-16 16z"/>
                        <path d="M24 14c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm0 16c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z"/>
                    </svg>
                </a>
            </div>

            <div class="card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>