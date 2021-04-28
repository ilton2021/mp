<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gestor extends Model
{
    protected $table = 'gestor';
	
	protected $fillable = [
		'nome',
		'email',
		'cpf',
		'cargo',
		'funcao',
		'gestor_imediato',
		'gestor_sim',
		'unidade_id',
		'created_at',
		'updated_at'
	];
}
