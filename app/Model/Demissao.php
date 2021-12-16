<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Demissao extends Model
{
    protected $table = 'demissao';
	
	protected $fillable = [
		'mp_id',
		'unidade_id',
		'tipo_desligamento',
		'aviso_previo',
		'ultimo_dia',
		'custo_recisao',
		'salario_bruto',
		'gestor_criador_mp',
		'created_at',
		'updated_at'
	];
}
