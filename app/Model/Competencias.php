<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Competencias extends Model
{
    protected $table = 'competencias';
	
	protected $fillable = [
		'descricao',
		'outros',
		'vaga_id',
		'created_at',
		'updated_at'
	];
}
