<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAprovacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aprovacao', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidade');
			$table->unsignedBigInteger('mp_id');
            $table->foreign('mp_id')->references('id')->on('mp');
			$table->string('resposta');
			$table->date('data_aprovacao');
			$table->unsignedBigInteger('gestor_id');
            $table->foreign('gestor_id')->references('id')->on('gestor');
			$table->unsignedBigInteger('gestor_anterior');
            $table->foreign('gestor_anterior')->references('id')->on('gestor');
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
        Schema::dropIfExists('aprovacao');
    }
}
