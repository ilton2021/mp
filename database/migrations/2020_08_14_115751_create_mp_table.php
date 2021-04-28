<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpTable extends Migration
{
    public function up()
    {
        Schema::create('mp', function (Blueprint $table) {
            $table->bigIncrements('id');
	    $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidade');
	    $table->string('local_trabalho');
	    $table->string('solicitante');
	    $table->string('nome');
	    $table->unsignedBigInteger('gestor_id');
            $table->foreign('gestor_id')->references('id')->on('gestor');
	    $table->string('departamento');
	    $table->date('data_emissao');
	    $table->date('data_prevista');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mp');
    }
}
