<?php

namespace App\Http\Controllers;

use App\Mail\RelatorioOrdensMail;
use App\Models\Cliente;
use App\Models\OrdemServico;
use App\Models\Veiculo;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class OrdemServicoController extends Controller
{
    public function index()
    {
        $ordens = OrdemServico::with(['cliente', 'veiculo'])->get();

        return view('ordens.index', compact('ordens'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $veiculos = Veiculo::all();

        return view('ordens.create', compact('clientes', 'veiculos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'veiculo_id' => 'required|exists:veiculos,placa',
            'descricao' => 'required|string|max:1000',
            'data_servico' => 'required|date',
        ]);

        OrdemServico::create([
            'cliente_id' => $request->cliente_id,
            'veiculo_id' => $request->veiculo_id,
            'descricao' => $request->descricao,
            'data_servico' => $request->data_servico,
        ]);

        return redirect()->route('ordens.index')->with('success', 'Ordem de serviço cadastrada com sucesso!');
    }

    public function edit(OrdemServico $ordem)
    {
        $clientes = Cliente::all();
        $veiculos = Veiculo::all();

        return view('ordens.edit', compact('ordem', 'clientes', 'veiculos'));
    }

    public function update(Request $request, OrdemServico $ordem)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'veiculo_id' => 'required|exists:veiculos,placa',
            'descricao' => 'required|string|max:1000',
            'data_servico' => 'required|date',
        ]);

        $ordem->update($request->all());

        return redirect()->route('ordens.index')->with('success', 'Ordem de serviço atualizada com sucesso!');
    }

    public function destroy(OrdemServico $ordem)
    {
        $ordem->delete();

        return redirect()->route('ordens.index')->with('success', 'Ordem de serviço excluída com sucesso!');
    }

    // ✅ Gera o PDF
    public function gerarRelatorioPDF()
    {
        $ordens = OrdemServico::with(['cliente', 'veiculo'])->get();
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

    // ✅ Envia o PDF por e-mail
    public function enviarRelatorioPorEmail()
    {
        Mail::to('destinatario@example.com')->send(new RelatorioOrdensMail());

        return redirect()->route('ordens.index')->with('success', 'Relatório enviado por e-mail!');
    }

    // ✅ Envia o link do PDF por WhatsApp (Twilio)
    public function enviarRelatorioPorWhatsApp()
    {
        $ordens = OrdemServico::with(['cliente', 'veiculo'])->get();
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
}
