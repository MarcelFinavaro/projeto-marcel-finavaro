<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{
    public function index()
    {
        $ordens = OrdemServico::with('veiculo')->get();

        return view('ordens-servico.index', compact('ordens'));
    }

    public function create()
    {
        $veiculos = Veiculo::all();

        return view('ordens-servico.create', compact('veiculos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'data' => 'required|date',
            'veiculo_id' => 'required|exists:veiculos,id',
        ]);

        OrdemServico::create($request->all());

        return redirect()->route('ordens-servico.index')->with('success', 'Ordem de serviço cadastrada com sucesso!');
    }

    public function show(OrdemServico $ordens_servico)
    {
        return view('ordens-servico.show', ['ordemServico' => $ordens_servico]);
    }

    public function edit(OrdemServico $ordens_servico)
    {
        $veiculos = Veiculo::all();

        return view('ordens-servico.edit', ['ordemServico' => $ordens_servico, 'veiculos' => $veiculos]);
    }

    public function update(Request $request, OrdemServico $ordens_servico)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'data' => 'required|date',
            'veiculo_id' => 'required|exists:veiculos,id',
        ]);

        $ordens_servico->update($request->all());

        return redirect()->route('ordens-servico.index')->with('success', 'Ordem de serviço atualizada com sucesso!');
    }

    public function destroy(OrdemServico $ordens_servico)
    {
        $ordens_servico->delete();

        return redirect()->route('ordens-servico.index')->with('success', 'Ordem de serviço excluída com sucesso!');
    }
}
