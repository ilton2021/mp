<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AprovacaoVagaInterna extends Model
{
    protected $table = 'aprovacao_vaga_interna';

    protected $fillable = [
        'unidade_id',
        'gestor_id',
        'vaga_interna_id',
        'gestor_anterior',
        'resposta',
        'data_aprovacao',
        'motivo',
        'ativo',
        'created_at',
        'updated_at'
    ];
}
