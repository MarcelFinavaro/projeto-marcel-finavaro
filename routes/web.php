<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\VeiculoController;
use Illuminate\Support\Facades\Route;

Route::get('/debug-check', function () {
    return config('app.debug') ? 'Debug está ativado' : 'Debug está desativado';
});

Route::get('/', function () {
    return view('welcome');
});

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
