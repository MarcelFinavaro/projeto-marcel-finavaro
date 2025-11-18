<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'cpf',
        'nome',
        'telefone',
        'email',
        'user_id', // ✅ necessário para salvar corretamente
    ];

    public function ordens()
    {
        return $this->hasMany(Ordem::class);
    }

    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }
}
