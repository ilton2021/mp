<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class AdmissaoRPA extends Model
{
    protected $table = 'admissao_rpa';

    protected $fillable = [
        'mp_id',
        'unidade_id',
        'cargo',
        'salario',
        'outras_verbas',
        'horario_trabalho',
        'escala_trabalho',
        'centro_custo',
        'jornada',
        'turno',
        'periodo_contrato',
        'periodo_inicio',
        'periodo_fim',
        'qtdDias',
        'possibilidade_contratacao',
        'necessidade_email',
        'substituto',
        'motivo',
        'motivo2',
        'departamento',
        'quantidade_plantao',
        'valor_plantao',
        'valor_pago_plantao',
        'cargos_rpa_id',
        'gestor_criador_mp',
        'created_at',
        'updated_at'
    ];
}
