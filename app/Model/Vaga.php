<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
	protected $table = 'vaga';
	
    protected $fillable = [
		'unidade_id',
		'local_trabalho',
		'solicitante',
		'vaga',
		'codigo_vaga',
		'numeroVaga',
		'ordem',
		'gestor_id',
		'area',
		'edital_disponivel',
		'data_prevista',
		'cargo',
		'salario',
		'horario_trabalho',
		'escala_trabalho',
		'centro_custo',
		'jornada',
		'turno',
		'tipo',
		'periodo_contrato',
		'motivo',
		'motivo2',
		'salario_base',
		'data_demissao',
		'contratacao_deficiente',
		'email',
		'conhecimento_tecnico',
		'conhecimento_desejado',
		'formacao',
		'idiomas',
		'tipo_vaga',
		'concluida',
		'aprovada',
		'inativa',
		'data_emissao',
		'created_at',
		'updated_at'
	];
}
