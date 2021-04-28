<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionario';
	
	protected $fillable = [
		'nome_completo',
		'matricula',
		'cpf',
		'cargo',
		'telefone',
		'unidade',
		'atividades',
		'declaracao',
		'email',
		'created_at',
		'updated_at'
	];
}
