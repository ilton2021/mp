<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Loggers extends Model
{
    protected $table = 'loggers';

    protected $fillable = [
        'user_id',
        'acao',
        'created_at',
        'updated_at'
    ];
}
