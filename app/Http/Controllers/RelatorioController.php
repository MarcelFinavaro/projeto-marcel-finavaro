<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorios.index');
    }

    public function veiculoPorPlaca($placa)
    {
        $veiculo = Veiculo::with(['cliente', 'ordens'])->where('placa', $placa)->first();

        if (!$veiculo) {
            return redirect()->route('relatorios.index')->with('error', 'Veículo não encontrado.');
        }

        return view('relatorios.veiculo', compact('veiculo'));
    }
}
