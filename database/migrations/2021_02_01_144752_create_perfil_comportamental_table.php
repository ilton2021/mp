<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilComportamentalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_comportamental', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('descricao');
			$table->unsignedBigInteger('vaga_id');
            $table->foreign('vaga_id')->references('id')->on('vaga');
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
        Schema::dropIfExists('perfil_comportamental');
    }
}
