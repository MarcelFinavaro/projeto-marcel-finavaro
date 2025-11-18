<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordem extends Model
{
    protected $table = 'ordem_servicos'; // ✅ Define o nome correto da tabela

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cpf', 'cpf');
    }

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'placa', 'placa');
    }
}
