<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    // Lista todos os veículos
    public function index(Request $request)
    {
        $query = Veiculo::where('user_id', auth()->id());

        if ($request->filled('placa')) {
            $query->where('placa', $request->placa); // busca exata
        }

        $veiculos = $query->get();

        return view('veiculos.index', compact('veiculos'));
    }

    // Exibe o formulário de cadastro
    public function create()
    {
        $clientes = Cliente::where('user_id', auth()->id())->get();

        return view('veiculos.create', compact('clientes'));
    }

    // Salva o veículo no banco
    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|unique:veiculos,placa',
            'modelo' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'ano' => 'required|integer|min:1900|max:'.date('Y'),
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        Veiculo::create([
            'placa' => $request->placa,
            'modelo' => $request->modelo,
            'marca' => $request->marca,
            'ano' => $request->ano,
            'cliente_id' => $request->cliente_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('veiculos.index')->with('success', 'Veículo cadastrado com sucesso!');
    }

    // Exibe o formulário de edição
    public function edit($placa)
    {
        $veiculo = Veiculo::findOrFail($placa);
        $clientes = Cliente::where('user_id', auth()->id())->get();

        return view('veiculos.edit', compact('veiculo', 'clientes'));
    }

    // Atualiza os dados do veículo
    public function update(Request $request, $placa)
    {
        $veiculo = Veiculo::findOrFail($placa);

        $request->validate([
            'placa' => 'required|string|unique:veiculos,placa,'.$veiculo->placa.',placa',
            'modelo' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'ano' => 'required|integer|min:1900|max:'.date('Y'),
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        $veiculo->update([
            'modelo' => $request->modelo,
            'marca' => $request->marca,
            'ano' => $request->ano,
            'cliente_id' => $request->cliente_id,
        ]);

        return redirect()->route('veiculos.index')->with('success', 'Veículo atualizado com sucesso!');
    }

    // Exclui o veículo
    public function destroy($placa)
    {
        $veiculo = Veiculo::findOrFail($placa);
        $veiculo->delete();

        return redirect()->route('veiculos.index')->with('success', 'Veículo excluído com sucesso!');
    }

    // Busca por placa parcial
    public function buscar(Request $request)
    {
        $placa = $request->input('placa');

        $veiculos = Veiculo::where('placa', 'like', '%'.$placa.'%')->get();

        return view('veiculos.resultado', compact('veiculos', 'placa'));
    }

    // Busca exata por placa (chave primária)
    public function buscarPorPlaca(Request $request)
    {
        $placa = $request->input('placa');

        $veiculo = Veiculo::with('cliente')->find($placa);

        if ($veiculo) {
            return view('veiculos.resultado-unico', compact('veiculo'));
        } else {
            return redirect()->back()->with('erro', 'Veículo não encontrado.');
        }
    }
}
