<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissaoSalariosUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissao_salarios_unidades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidade'); 
            $table->unsignedBigInteger('admissao_hcp_id');
            $table->foreign('admissao_hcp_id')->references('id')->on('admissao_hcp'); 
            $table->string('gestor');
            $table->string('salario');
            $table->string('outras_verbas');
            $table->string('cargo');
            $table->string('centro_custo');
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
        Schema::dropIfExists('admissao_salarios_unidades');
    }
}
