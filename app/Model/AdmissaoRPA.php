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
        'periodo_inicio_2',
        'periodo_inicio_3',
        'periodo_fim',
        'periodo_fim_2',
        'periodo_fim_3',
        'qtdDias',
        'qtdDias_2',
        'qtdDias_3',
        'possibilidade_contratacao',
        'necessidade_email',
        'substituto',
        'motivo',
        'motivo2',
        'departamento',
        'quantidade_plantao',
        'quantidade_plantao_2',
        'quantidade_plantao_3',
        'valor_plantao',
        'valor_plantao_2',
        'valor_plantao_3',
        'valor_pago_plantao',
        'valor_pago_plantao_2',
        'valor_pago_plantao_3',
        'cargos_rpa_id',
        'cargos_rpa_id_2',
        'cargos_rpa_id_3',
        'gestor_criador_mp',
        'created_at',
        'updated_at'
    ];
}
