<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PerfilComportamentalVagaInterna extends Model
{
    protected $table = 'perfil_comportamental_vaga_interna';

    protected $fillable = [
        'descricao',
        'outros',
        'vaga_interna_id',
        'created_at',
        'updated_at'
    ];
}
