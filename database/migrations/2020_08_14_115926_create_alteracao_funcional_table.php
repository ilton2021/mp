<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlteracaoFuncionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alteracao_funcional', function (Blueprint $table) {
            $table->bigIncrements('id');
	    $table->unsignedBigInteger('mp_id');
            $table->foreign('mp_id')->references('id')->on('mp');
	    $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidade');
	    $table->string('setor');
	    $table->string('cargo_novo');
	    $table->string('horario_novo');
	    $table->string('salario_atual');
	    $table->string('salario_novo');
	    $table->string('centro_custo_novo');
	    $table->string('motivo');
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
        Schema::dropIfExists('alteracao_funcional');
    }
}
