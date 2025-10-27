<?php

namespace App\Mail;

use App\Models\OrdemServico;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RelatorioOrdensMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function build()
    {
        $ordens = OrdemServico::with(['cliente', 'veiculo'])->get();
        $html = view('relatorios.ordens', compact('ordens'))->render();

        $options = new Options();
        $options->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $this->subject('Relatório de Ordens de Serviço')
                    ->markdown('emails.relatorio')
                    ->attachData($dompdf->output(), 'relatorio_ordens.pdf');
    }
}
