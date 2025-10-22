<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    use HasFactory;

    protected $fillable = ['descricao', 'data', 'veiculo_id'];

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}
