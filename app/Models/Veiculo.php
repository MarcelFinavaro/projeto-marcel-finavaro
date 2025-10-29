<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    // Define que a chave primária da tabela 'veiculos' é o campo 'placa'
    protected $primaryKey = 'placa';

    // Indica que a chave primária não é auto-incrementável (como um ID numérico)
    public $incrementing = false;

    // Define o tipo da chave primária como string (placa é texto)
    protected $keyType = 'string';

    // Campos que podem ser preenchidos em massa (via create ou update)
    protected $fillable = ['placa', 'modelo', 'marca', 'ano', 'cliente_cpf'];

    // Relacionamento: um veículo pertence a um cliente
    // Usa 'cliente_cpf' como chave estrangeira que aponta para 'cpf' na tabela 'clientes'
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_cpf', 'cpf');
    }

    // Relacionamento: um veículo pode ter várias ordens de serviço
    // Usa 'veiculo_placa' como chave estrangeira na tabela 'ordem_servicos'
    public function ordens()
    {
        return $this->hasMany(OrdemServico::class, 'veiculo_placa', 'placa');
    }
}
