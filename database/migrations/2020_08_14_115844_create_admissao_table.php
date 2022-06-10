<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissao', function (Blueprint $table) {
            $table->bigIncrements('id');
	        $table->unsignedBigInteger('mp_id');
            $table->foreign('mp_id')->references('id')->on('mp');
            $table->string('cargo');
            $table->string('salario');
            $table->string('horario_trabalho');
            $table->string('escala_trabalho');
            $table->string('centro_custo');
            $table->string('jornada');
            $table->string('turno');
            $table->string('tipo');
            $table->string('periodo_contrato');
            $table->string('motivo');
            $table->string('motivo2');
            $table->string('possibilidade_contratacao');
            $table->string('necessidade_email');
            $table->unsignedBigInteger('gestor_criador_id');
            $table->foreign('gestor_id')->references('id')->on('gestor');
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
        Schema::dropIfExists('admissao');
    }
}
