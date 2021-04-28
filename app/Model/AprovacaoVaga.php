<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AprovacaoVaga extends Model
{
    protected $table = 'aprovacao_vaga';
	
	protected $fillable = [
		'unidade_id',
		'vaga_id',
		'resposta',
		'data_aprovacao',
		'gestor_id',
		'gestor_anterior',
		'motivo',
		'ativo',
		'created_at',
		'updated_at'
	];
}
