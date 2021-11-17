<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MP extends Model
{
    protected $table = 'mp';
	
	protected $fillable = [
		'unidade_id',
		'local_trabalho',
		'solicitante',
		'numeroMP',
		'ordem',
		'matricula',
		'nome',
		'gestor_id',
		'impacto_financeiro',
		'departamento',
		'tipo_mp',
		'data_emissao',
		'data_prevista',
		'concluida',
		'aprovada',
		'acessorh3',
		'usuario_acessorh3',
		'created_at',
		'updated_at'
	];
}
