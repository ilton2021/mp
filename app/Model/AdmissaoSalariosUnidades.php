<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdmissaoSalariosUnidades extends Model
{
    protected $table = 'admissao_salarios_unidades';

    protected $fillable = [
        'admissao_hcp_id',
        'gestor',
        'unidade_id',
        'salario',
        'outras_verbas',
        'cargo',
        'centro_custo',
        'created_at',
        'updated_at'
    ];
}
