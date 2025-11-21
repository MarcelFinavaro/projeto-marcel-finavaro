<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Vite</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl text-blue-600 font-bold">Test Vite</h1>
            <p class="text-green-600 mt-2">Se isso estiver azul e verde, o CSS funciona!</p>
            <p class="text-red-500 mt-2">E isso deve estar vermelho!</p>
        </div>
    </div>
</body>
</html>