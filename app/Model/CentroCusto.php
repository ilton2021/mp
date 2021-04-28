<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CentroCusto extends Model
{
    protected $table = 'centro_custo';
	
	protected $fillable = [
		'nome',
		'unidade',
		'created_at',
		'updated_at'
	];
}
