<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJustificativaVagaInternaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('justificativa_vaga_interna', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descricao');
            $table->unsignedBigInteger('vaga_interna_id');
            $table->foreign('vaga_interna_id')->references('id')->on('vaga_interna');
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
        Schema::dropIfExists('justificativa_vaga_interna');
    }
}
