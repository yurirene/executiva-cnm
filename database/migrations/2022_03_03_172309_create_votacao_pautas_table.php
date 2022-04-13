<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotacaoPautasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votacao_pautas', function (Blueprint $table) {
            $table->id();
            $table->string('delegado_id');
            $table->bigInteger('pauta_id')->unsigned();
            $table->string('voto', 10);
            $table->timestamps();

            $table->foreign('pauta_id')->references('id')->on('pautas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votacao_pautas');
    }
}
