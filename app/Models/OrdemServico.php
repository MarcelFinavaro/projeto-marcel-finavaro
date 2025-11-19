<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    use HasFactory;

    protected $fillable = [
        'veiculo_placa',
        'descricao',
        'data_servico',
        'mao_obra',
        // 'valor_total', // se decidir salvar o total calculado
    ];

    /*
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cpf', 'cpf');
    }
    */
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'veiculo_placa', 'placa');
    }

    public function pecas()
    {
        return $this->hasMany(PecaOS::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
