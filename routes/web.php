<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\VeiculoController;
use Illuminate\Support\Facades\Route;

// 🔍 ROTAS DE TESTE TEMPORÁRIAS (adicionar no início)
Route::get('/test-guest', function () {
    return view('auth.login');
});

Route::get('/test-html', function () {
    return '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Test</title>
        @vite(["resources/css/app.css", "resources/js/app.js"])
    </head>
    <body>
        <h1 class="text-2xl text-blue-600 bg-red-100 p-4">Teste Directo - Se isso estiver azul com fundo vermelho, o CSS funciona!</h1>
    </body>
    </html>
    ';
});

Route::get('/test-manual', function () {
    return view('test-vite');
});

// NOVAS ROTAS DE TESTE - adicione junto com as outras
Route::get('/debug-assets', function () {
    $buildPath = public_path('build');

    return [
        'build_directory_exists' => file_exists($buildPath),
        'build_contents' => file_exists($buildPath) ? scandir($buildPath) : 'NO BUILD DIR',
        'assets_path' => [
            'css' => file_exists(public_path('build/assets/app-kUNBWEmv.css')) ? 'EXISTS' : 'NOT FOUND',
            'js' => file_exists(public_path('build/assets/app-kGY04szw.js')) ? 'EXISTS' : 'NOT FOUND',
            'manifest' => file_exists(public_path('build/manifest.json')) ? 'EXISTS' : 'NOT FOUND',
        ],
        'actual_css_path' => file_exists(public_path('build/assets/app-kUNBWEmv.css')) ?
            'build/assets/app-kUNBWEmv.css' : 'NOT FOUND',
        'actual_js_path' => file_exists(public_path('build/assets/app-kGY04szw.js')) ?
            'build/assets/app-kGY04szw.js' : 'NOT FOUND',
    ];
});
Route::get('/test-dynamic', function () {
    $cssPath = file_exists(public_path('build/assets/app-kUNBWEmv.css')) ?
        'build/assets/app-kUNBWEmv.css' : 'build/assets/app.css';
    $jsPath = file_exists(public_path('build/assets/app-kGY04szw.js')) ?
        'build/assets/app-kGY04szw.js' : 'build/assets/app.js';

    return '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Test Dynamic</title>
        <link href="'.asset($cssPath).'" rel="stylesheet">
    </head>
    <body>
        <h1 class="text-2xl text-blue-600 bg-red-100 p-4">Test Dynamic - Se azul com fundo vermelho, funciona!</h1>
        <script src="'.asset($jsPath).'" defer></script>
    </body>
    </html>
    ';
});
// FIM DAS ROTAS DE TESTE

Route::get('/test-csrf', function () {
    session()->start(); // Force session start

    return [
        'csrf_token' => csrf_token(),
        'session_id' => session()->getId(),
        'session_status' => session()->status(),
    ];
});

Route::get('/debug-check', function () {
    return config('app.debug') ? 'Debug está ativado' : 'Debug está desativado';
});

Route::get('/', function () {
    return view('auth.login');
});
/*Route::get('/', function () {
    return view('welcome');
});*/

// Dashboard com contadores
Route::get('/veiculos/buscar', [VeiculoController::class, 'buscar'])->name('veiculos.buscar');

Route::get('/dashboard', function () {
    $totalOrdens = App\Models\OrdemServico::count();
    $totalVeiculos = App\Models\Veiculo::count();

    return view('dashboard', compact('totalOrdens', 'totalVeiculos'));
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔐 Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    Route::get('/buscar-veiculo', [VeiculoController::class, 'buscarPorPlaca'])->name('veiculo.buscar');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('clientes', ClienteController::class);
    Route::resource('veiculos', VeiculoController::class);
    Route::resource('ordens', OrdemServicoController::class)->parameters([
        'ordens' => 'ordem',
    ]);

    Route::get('/ordens/buscar', [OrdemServicoController::class, 'buscarPorPlaca'])->name('ordens.buscar');
    Route::get('/clientes/buscar/nome', [ClienteController::class, 'buscarPorNome'])->name('clientes.buscar.nome');
    Route::get('/clientes/buscar/cpf', [ClienteController::class, 'buscarPorCpf'])->name('clientes.buscar.cpf');

    Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
    Route::get('/relatorios/por-placa', [RelatorioController::class, 'formPlaca'])->name('relatorios.placa');
    Route::post('/relatorios/por-placa', [RelatorioController::class, 'buscarPorPlaca'])->name('relatorios.placa.buscar');
    Route::get('/relatorios/por-data', [RelatorioController::class, 'formData'])->name('relatorios.data');
    Route::post('/relatorios/por-data', [RelatorioController::class, 'buscarPorData'])->name('relatorios.data.buscar');
    Route::post('/relatorios/gerar-pdf', [RelatorioController::class, 'gerarPDF'])->name('relatorios.gerar.pdf');
    Route::get('/ordens/relatorio/pdf', [OrdemServicoController::class, 'gerarRelatorioPDF'])->name('ordens.relatorio.pdf');
});

// ✅ Agora fora do grupo protegido
require __DIR__.'/auth.php';
