<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comportamental extends Model
{
    protected $table = 'perfil_comportamental';
	
	protected $fillable = [
		'descricao',
		'outros',
		'vaga_id',
		'created_at',
		'updated_at'
	];
}
