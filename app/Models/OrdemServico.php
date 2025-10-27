<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos em massa
    protected $fillable = ['cliente_id', 'veiculo_id', 'descricao', 'data_servico'];

    // Relacionamento com Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relacionamento com Veículo usando 'placa' como chave primária
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'veiculo_id', 'placa');
    }
}
