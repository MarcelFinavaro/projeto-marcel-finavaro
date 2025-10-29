<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos em massa
    protected $fillable = ['cliente_cpf', 'veiculo_placa', 'descricao', 'data_servico'];

    // Relacionamento com Cliente
    // Usa 'cliente_cpf' como chave estrangeira que aponta para 'cpf' na tabela 'clientes'
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_cpf', 'cpf');
    }

    // Relacionamento com Veículo
    // Usa 'veiculo_placa' como chave estrangeira que aponta para 'placa' na tabela 'veiculos'
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'veiculo_placa', 'placa');
    }
}
