<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $table = 'unidade';
	
	protected $fillable = [
		'nome',
		'imagem',
		'caminho',
		'sigla',
		'created_at',
		'updated_at'
	];
}
