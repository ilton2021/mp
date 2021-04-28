<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JustificativaVaga extends Model
{
    protected $table = 'justificativa_vaga';
	
	protected $fillable = [
		'descricao',
		'vaga_id',
		'created_at',
		'updated_at'
	];
}
