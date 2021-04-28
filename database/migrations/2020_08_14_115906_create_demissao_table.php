<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemissaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demissao', function (Blueprint $table) {
            $table->bigIncrements('id');
	    $table->unsignedBigInteger('mp_id');
            $table->foreign('mp_id')->references('id')->on('mp');
	    $table->string('tipo_desligamento');
	    $table->string('aviso_previo');
	    $table->date('ultimo_dia');
	    $table->string('custo_recisao');
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
        Schema::dropIfExists('demissao');
    }
}
