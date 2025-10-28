<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    // Define que a chave primária é 'placa'
    protected $primaryKey = 'placa';

    // Indica que a chave primária não é auto-incrementável
    public $incrementing = false;

    // Define o tipo da chave primária como string
    protected $keyType = 'string';

    // Campos que podem ser preenchidos em massa
    protected $fillable = ['placa', 'modelo', 'marca', 'ano', 'cliente_id'];

    // Relacionamento com Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relacionamento com Ordens de Serviço
    public function ordens()
    {
        return $this->hasMany(OrdemServico::class, 'veiculo_id', 'placa');
    }
}
