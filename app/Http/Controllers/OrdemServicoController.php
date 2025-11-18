<?php

namespace App\Http\Controllers;

use App\Mail\RelatorioOrdensMail;
use App\Models\OrdemServico;
use App\Models\Veiculo;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class OrdemServicoController extends Controller
{
    public function index()
    {
        $ordens = OrdemServico::with(['veiculo'])->get();

        return view('ordens.index', compact('ordens'));
    }

    public function create()
    {
        $veiculos = Veiculo::all();

        return view('ordens.create', compact('veiculos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|string',
            'descricao' => 'required|string|max:1000',
            'data_servico' => 'required|date',
            'mao_obra' => 'required|numeric|min:0',
        ]);

        OrdemServico::create([
            'veiculo_placa' => $request->placa,
            'descricao' => $request->descricao,
            'data_servico' => $request->data_servico,
            'mao_obra' => $request->mao_obra,
        ]);

        return redirect()->route('ordens.index')->with('success', 'Ordem de serviço criada com sucesso!');
    }

    public function edit($id)
    {
        $ordem = OrdemServico::with('pecas')->findOrFail($id);
        $veiculos = Veiculo::all();

        return view('ordens.edit', compact('ordem', 'veiculos'));
    }

    public function update(Request $request, OrdemServico $ordem)
    {
        $request->validate([
            'descricao' => 'required|string|max:1000',
            'data_servico' => 'required|date',
            'mao_obra' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $ordem) {
            // Atualiza os dados principais da OS
            $ordem->update([
                'descricao' => $request->descricao,
                'data_servico' => $request->data_servico,
                'mao_obra' => $request->mao_obra,
            ]);

            // Remove todas as peças anteriores
            $ordem->pecas()->delete();

            // Reinsere as peças, se houver
            if ($request->has('pecas')) {
                foreach ($request->pecas as $peca) {
                    if (!empty($peca['nome_peca'])) {
                        $ordem->pecas()->create([
                            'nome_peca' => $peca['nome_peca'],
                            'quantidade' => $peca['quantidade'],
                            'preco_unitario' => $peca['preco_unitario'],
                        ]);
                    }
                }
            }
        });

        return redirect()->route('ordens.index')->with('success', 'Ordem de serviço atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $ordem = OrdemServico::findOrFail($id);
        $ordem->delete();

        return redirect()->route('ordens.index')->with('success', 'Ordem de serviço excluída com sucesso!');
    }

    public function gerarRelatorioPDF()
    {
        $ordens = OrdemServico::with(['veiculo'])->get();
        $html = view('relatorios.ordens', compact('ordens'))->render();

        $options = new Options();
        $options->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output())
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="relatorio_ordens.pdf"');
    }

    public function enviarRelatorioPorEmail()
    {
        Mail::to('destinatario@example.com')->send(new RelatorioOrdensMail());

        return redirect()->route('ordens.index')->with('success', 'Relatório enviado por e-mail!');
    }

    public function enviarRelatorioPorWhatsApp()
    {
        $ordens = OrdemServico::with(['veiculo'])->get();
        $html = view('relatorios.ordens', compact('ordens'))->render();

        $options = new Options();
        $options->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $path = storage_path('app/public/relatorio_ordens.pdf');
        file_put_contents($path, $dompdf->output());

        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $twilio = new Client($sid, $token);

        $twilio->messages->create(
            'whatsapp:+55SEUNUMERO',
            [
                'from' => 'whatsapp:+14155238886',
                'body' => 'Segue o relatório de ordens de serviço.',
                'mediaUrl' => ['https://seusite.com/storage/relatorio_ordens.pdf'],
            ]
        );

        return redirect()->route('ordens.index')->with('success', 'Relatório enviado por WhatsApp!');
    }

    public function buscarPorPlaca(Request $request)
    {
        $placa = $request->input('placa');

        if (!$placa) {
            return redirect()->route('ordens.index')->with('error', 'Informe uma placa para buscar.');
        }

        $veiculo = Veiculo::where('placa', $placa)->first();

        if (!$veiculo) {
            return redirect()->route('ordens.index')->with('error', 'Veículo com essa placa não encontrado.');
        }

        $ordens = OrdemServico::where('veiculo_placa', $veiculo->placa)
            ->with(['veiculo'])
            ->get();

        return view('ordens.index', compact('ordens'));
    }
}
