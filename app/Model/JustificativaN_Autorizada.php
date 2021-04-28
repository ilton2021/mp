<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JustificativaN_Autorizada extends Model
{
    protected $table = 'justificativa_nautorizada';

    protected $fillable = [
	'mp_id',
	'autorizado',
	'justificativa',
	'gestor_id',
	'created_at',
	'updated_at'
    ];
}
