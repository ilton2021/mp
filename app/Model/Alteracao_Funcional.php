<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Alteracao_Funcional extends Model
{
    protected $table = 'alteracao_funcional';
	
	protected $fillable = [
		'mp_id',
		'unidade_id',
		'setor',
		'cargo_atual',
		'cargo_novo',
		'horario_novo',
		'salario_atual',
		'salario_novo',
		'gratificacoes',
		'centro_custo_novo',
		'motivo',
		'gestor_criador_mp',
		'created_at',
		'updated_at'
	];
}
