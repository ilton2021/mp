<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CompetenciasVagaInterna extends Model
{
    protected $table = 'competencias_vaga_interna';

    protected $fillable = [
        'descricao',
        'outros',
        'vaga_interna_id',
        'created_at',
        'updated_at'
    ];
}
