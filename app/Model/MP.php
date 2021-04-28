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
		'departamento',
		'tipo_mp',
		'data_emissao',
		'data_prevista',
		'concluida',
		'aprovada',
		'created_at',
		'updated_at'
	];
}
