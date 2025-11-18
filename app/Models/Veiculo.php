<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Cliente|null                                     $cliente
 * @property User|null                                        $user
 * @property \Illuminate\Database\Eloquent\Collection|Ordem[] $ordens
 */
class Veiculo extends Model
{
    protected $primaryKey = 'placa';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'placa',
        'modelo',
        'marca',
        'ano',
        'cliente_id',
        'user_id',
    ];

    public function ordens()
    {
        return $this->hasMany(Ordem::class, 'placa', 'placa');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
