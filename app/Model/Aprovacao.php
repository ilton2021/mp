<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Aprovacao extends Model
{
    protected $table = 'aprovacao';
	
	protected $fillable = [
		'mp_id',
		'resposta',
		'data_aprovacao',
		'gestor_id',
		'gestor_anterior',
		'motivo',
		'ativo',
		'unidade_id',
		'created_at',
		'updated_at'
	];
}
