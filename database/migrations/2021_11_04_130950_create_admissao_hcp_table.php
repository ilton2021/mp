<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissaoHcpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissao_hcp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mp_id');
            $table->foreign('mp_id')->references('id')->on('mp');
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidade'); 
            $table->string('jornada');
            $table->string('tipo');
            $table->string('periodo_contrato');
            $table->string('motivo');
            $table->string('motivo2');
            $table->string('possibilidade_contratacao');
            $table->string('necessidade_email');
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
        Schema::dropIfExists('admissao_hcp');
    }
}
