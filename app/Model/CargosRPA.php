<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CargosRPA extends Model
{
    protected $table = 'cargos_rpa';

    protected $fillable = [
        'cargo',
        'tipo',
        'HMR',
        'BeloJardim',
        'Arcoverde',
        'Arruda',
        'Caruaru',
        'HSS',
        'HPR',
        'Igarassu',
        'created_at',
        'updated_at'
    ];
}
