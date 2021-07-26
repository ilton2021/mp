<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InscricaoVagaInterna extends Model
{
    protected $table = 'inscricao_vaga_interna';

    protected $fillable = [
        'unidade_id',
        'solicitante',
        'vaga_interna_id',
        'gestor_id',
        'nome_funcionario',
        'matricula_funcionario',
        'concluida',
        'aprovada',
        'data_emissao',
        'data_aprovacao',
        'created_at',
        'updated_at'
    ];
}
