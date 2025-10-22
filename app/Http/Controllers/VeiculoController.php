<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    // Lista todos os veículos
    public function index()
    {
        $veiculos = Veiculo::with('cliente')->get();

        return view('veiculos.index', compact('veiculos'));
    }

    // Exibe o formulário de cadastro
    public function create()
    {
        $clientes = Cliente::all();

        return view('veiculos.create', compact('clientes'));
    }

    // Salva o veículo no banco
    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|unique:veiculos,placa',
            'modelo' => 'required|string|max:255',
            'ano' => 'required|integer|min:1900|max:'.date('Y'),
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        Veiculo::create($request->all());

        return redirect()->route('veiculos.index')->with('success', 'Veículo cadastrado com sucesso!');
    }

    // Exibe o formulário de edição
    public function edit(Veiculo $veiculo)
    {
        $clientes = Cliente::all();

        return view('veiculos.edit', compact('veiculo', 'clientes'));
    }

    // Atualiza os dados do veículo
    public function update(Request $request, Veiculo $veiculo)
    {
        $request->validate([
            'placa' => 'required|string|unique:veiculos,placa,'.$veiculo->id,
            'modelo' => 'required|string|max:255',
            'ano' => 'required|integer|min:1900|max:'.date('Y'),
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        $veiculo->update($request->all());

        return redirect()->route('veiculos.index')->with('success', 'Veículo atualizado com sucesso!');
    }

    // Exclui o veículo
    public function destroy(Veiculo $veiculo)
    {
        $veiculo->delete();

        return redirect()->route('veiculos.index')->with('success', 'Veículo excluído com sucesso!');
    }
}
