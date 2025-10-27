<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\VeiculoController;
use Illuminate\Support\Facades\Route;

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

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    // Perfil do usuário
    Route::get('/buscar-veiculo', [VeiculoController::class, 'buscarPorPlaca'])->name('veiculo.buscar');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Recursos principais
    Route::get('/ordens/relatorio/pdf', [OrdemServicoController::class, 'gerarRelatorioPDF'])->name('ordens.relatorio.pdf');
    Route::resource('clientes', ClienteController::class);
    Route::resource('veiculos', VeiculoController::class);
    Route::resource('ordens', OrdemServicoController::class)->parameters([
        'ordens' => 'ordem',
    ]);

    // Relatórios
    Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
});

// Autenticação (login, registro, etc.)
require __DIR__.'/auth.php';
