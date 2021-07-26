<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JustificativaVagaInterna extends Model
{
    protected $table = 'justificativa_vaga_interna';

    protected $fillable = [
        'descricao',
        'vaga_interna_id',
        'created_at',
        'updated_at'
    ];
}
