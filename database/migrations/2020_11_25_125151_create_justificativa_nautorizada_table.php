<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJustificativaNautorizadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('justificativa_nautorizada', function (Blueprint $table) {
            $table->bigIncrements('id');
	    $table->unsignedBigInteger('mp_id');
            $table->foreign('mp_id')->references('id')->on('mp');
	    $table->string('autorizado');		
	    $table->string('justificativa');
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
        Schema::dropIfExists('justificativa_nautorizada');
    }
}
