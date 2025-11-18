<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PecaOS extends Model
{
    use HasFactory;

    protected $table = 'pecas_os';

    protected $fillable = [
        'ordem_servico_id',
        'nome_peca',
        'quantidade',
        'preco_unitario',
    ];

    public function ordemServico()
    {
        return $this->belongsTo(OrdemServico::class);
    }
}
