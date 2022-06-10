<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissaoRpaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissao_rpa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mp_id');
            $table->foreign('mp_id')->references('id')->on('mp');
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidade');
            $table->string('cargo');
            $table->string('salario');
            $table->string('outras_verbas');
            $table->string('horario_trabalho');
            $table->string('escala_trabalho');
            $table->string('centro_custo');
            $table->string('jornada');
            $table->string('turno');
            $table->string('periodo_inicio');
            $table->string('periodo_fim');
            $table->string('qtdDias');
            $table->string('possibilidade_contratacao');
            $table->string('necessidade_email');
            $table->string('substituto');
            $table->string('motivo');
            $table->string('motivo2');
            $table->string('departamento');
            $table->string('qtd_plantao');
            $table->string('valor_plantao');
            $table->string('valor_pago_plantao');
            $table->unsignedBigInteger('cargos_rpa_id');
            $table->foreign('cargos_rpa_id')->references('id')->on('cargos_rpa');
            $table->unsignedBigInteger('gestor_criador_id');
            $table->foreign('gestor_criador_id')->references('id')->on('gestor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admissao_rpa');
    }
}
