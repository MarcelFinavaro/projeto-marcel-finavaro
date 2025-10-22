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

Route::get('/dashboard', function () {
    $totalOrdens = App\Models\OrdemServico::count();
    $totalVeiculos = App\Models\Veiculo::count();

    return view('dashboard', compact('totalOrdens', 'totalVeiculos'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cadastros
    Route::resource('clientes', ClienteController::class);
    Route::resource('veiculos', VeiculoController::class);
    Route::resource('ordens', OrdemServicoController::class);

    // Relatórios

    Route::middleware('auth')->group(function () {
        Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');

        Route::middleware('auth')->group(function () {
            Route::resource('clientes', ClienteController::class);
            Route::resource('veiculos', VeiculoController::class);
            Route::resource('ordens', OrdemServicoController::class);
            Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
        });
    });
});

require __DIR__.'/auth.php';
