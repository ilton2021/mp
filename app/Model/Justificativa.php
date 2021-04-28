<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Justificativa extends Model
{
    protected $table = 'justificativa';
	
	protected $fillable = [
		'mp_id',
		'descricao',
		'created_at',
		'updated_at'
	];
}
