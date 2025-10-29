<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $primaryKey = 'cpf';              // Define 'cpf' como chave primária
    public $incrementing = false;               // Chave primária não é auto-incrementável
    protected $keyType = 'string';              // Tipo da chave primária é string

    protected $fillable = ['cpf', 'nome', 'telefone', 'email'];

    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'cliente_cpf', 'cpf');
    }

    public function ordens()
    {
        return $this->hasMany(OrdemServico::class, 'cliente_cpf', 'cpf');
    }
}
