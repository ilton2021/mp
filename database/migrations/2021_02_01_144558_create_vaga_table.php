<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaga', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidade');
			$table->string('local_trabalho');
			$table->string('solicitante');
			$table->string('vaga');
			$table->string('codigo_vaga');
			$table->unsignedBigInteger('gestor_id');
            $table->foreign('gestor_id')->references('id')->on('gestor');
			$table->string('area');
			$table->string('disponivel_edital');
			$table->date('data_prevista');
			$table->string('salario');
			$table->string('horario_trabalho');
			$table->string('escala_trabalho');
			$table->string('jornada');
			$table->string('turno');
			$table->string('tipo');
			$table->string('motivo');
			$table->string('contratacao_deficiente');
			$table->string('email');
			$table->string('conhecimento_tecnico');
			$table->string('conhecimento_desejado');
			$table->string('formacao');
			$table->string('idiomas');
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
        Schema::dropIfExists('vaga');
    }
}
