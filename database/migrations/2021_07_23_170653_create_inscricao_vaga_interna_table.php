<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscricaoVagaInternaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscricao_vaga_interna', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidade');
            $table->unsignedBigInteger('solicitante');
            $table->foreign('solicitante')->references('id')->on('gestor');
            $table->unsignedBigInteger('vaga_interna_id');
            $table->foreign('vaga_interna_id')->references('id')->on('vaga_interna');
            $table->integer('gestor_id');
            $table->string('nome_funcionario');
            $table->string('matricula_funcionario');
            $table->string('concluida');
            $table->string('aprovada');
            $table->date('data_emissao');
            $table->date('data_aprovacao');
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
        Schema::dropIfExists('inscricao_vaga_interna');
    }
}
