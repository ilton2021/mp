<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CargosRPA extends Model
{
    protected $table = 'cargos_rpa';

    protected $fillable = [
        'cargo',
        'valor',
        'created_at',
        'updated_at'
    ];
}
