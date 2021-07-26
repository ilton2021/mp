<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVagaInternaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaga_interna', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('vaga');
			$table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidade');
            $table->string('local_trabalho');
            $table->string('solicitante');
            $table->string('codigo_vaga');
            $table->unsignedBigInteger('gestor_id');
            $table->foreign('gestor_id')->references('id')->on('gestor');
            $table->string('departamento');
            $table->date('data_emissao');
            $table->date('data_prevista');
            $table->string('unidade_atual');
            $table->string('unidade_proposta');
            $table->string('cargo_atual');
            $table->string('cargo_proposto');
            $table->string('centro_custo');
            $table->string('horario_trabalho');
            $table->string('salario_atual');
            $table->string('salario_proposto');
            $table->string('concluida');
            $table->string('aprovada');
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
        Schema::dropIfExists('vaga_interna');
    }
}
