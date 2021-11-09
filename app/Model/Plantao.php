<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Plantao extends Model
{
    protected $table = 'plantao';

    protected $fillable = [
        'mp_id',
		'unidade_id',
        'motivo_plantao',
        'quantidade_plantao',
        'valor_plantao',
		'valor_pago_plantao',
        'substituto',
        'centro_custo_plantao',
        'cargo_plantao',
        'setor_plantao',
		'created_at',
        'updated_at'
    ];
}
