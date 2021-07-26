<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VagaInterna extends Model
{
    protected $table = 'vaga_interna';

    protected $fillable = [
		'unidade_id',
		'local_trabalho',
		'solicitante',
		'vaga',
		'codigo_vaga',
		'gestor_id',
		'departamento',
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
		'contratacao_deficiente',
		'email',
		'conhecimento_tecnico',
		'conhecimento_desejado',
		'formacao',
		'idiomas',
		'concluida',
		'aprovada',
		'data_emissao',
		'created_at',
		'updated_at'
	];
}
