<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admissao extends Model
{
    protected $table = 'admissao';
	
	protected $fillable = [
		'cargo',
		'salario',
		'outras_verbas',
		'gratificacoes',
		'horario_trabalho',
		'escala_trabalho',
		'centro_custo',
		'jornada',
		'turno',
		'tipo',
		'periodo_contrato',
		'periodo_inicio',
		'periodo_fim',
		'motivo',
		'motivo2',
		'possibilidade_contratacao',
		'necessidade_email',
		'gestor_criador_mp',
		'mp_id',
		'unidade_id',
		'created_at',
		'updated_at'
	];
}
