<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAprovacaoVagaInternaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aprovacao_vaga_interna', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidade');
            $table->unsignedBigInteger('gestor_id');
            $table->foreign('gestor_id')->references('id')->on('gestor');
            $table->unsignedBigInteger('vaga_interna_id');
            $table->string('gestor_anterior');
            $table->foreign('vaga_interna_id')->references('id')->on('vaga_interna');
            $table->string('resposta');
            $table->date('data_aprovacao');
            $table->string('motivo');
            $table->string('ativo');
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
        Schema::dropIfExists('aprovacao_vaga_interna');
    }
}
