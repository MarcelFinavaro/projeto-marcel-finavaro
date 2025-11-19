<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    // Tela inicial de relatórios
    public function index()
    {
        return view('relatorios.index');
    }

    // 🔍 Relatório por placa — formulário
    public function formPlaca()
    {
        return view('relatorios.por_placa');
    }

    // 🔍 Relatório por placa — busca
    public function buscarPorPlaca(Request $request)
    {
        $ordens = OrdemServico::with(['veiculo', 'cliente', 'pecas'])
            ->where('veiculo_placa', $request->placa)
            ->get();

        return view('relatorios.resultado', compact('ordens'));
    }

    // 📅 Relatório por data — formulário
    public function formData()
    {
        return view('relatorios.por_data');
    }

    // 📅 Relatório por data — busca
    public function buscarPorData(Request $request)
    {
        $ordens = OrdemServico::with(['veiculo', 'cliente', 'pecas'])
            ->whereBetween('data_servico', [$request->data_inicio, $request->data_fim])
            ->get();

        return view('relatorios.resultado', compact('ordens'));
    }

    // 🧾 Geração de PDF de uma OS selecionada
    public function gerarPDF(Request $request)
    {
        $ordem = OrdemServico::with(['veiculo.cliente', 'pecas'])->findOrFail($request->ordem_id);

        $pdf = Pdf::loadView('relatorios.visual_os', compact('ordem'));

        return $pdf->download('relatorio_os_'.$ordem->id.'.pdf');
    }
}
