<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdmissaoHCP extends Model
{
    protected $table = 'admissao_hcp';

    protected $fillable = [
        'mp_id',
        'unidade_id',
        'jornada',
        'tipo',
        'periodo_contrato',
        'motivo',
        'motivo2',
        'possibilidade_contratacao',
        'necessidade_email',
        'created_at',
        'updated_at'
    ];
}
