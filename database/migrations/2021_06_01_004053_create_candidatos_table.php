<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('nome', 100);
            $table->string('federacao',100);
            $table->string('sinodal',100);
            $table->string('estado');
            $table->string('foto')->nullable();
            $table->boolean('status')->default(true);
            $table->bigInteger('cargo_id')->unsigned();
            $table->bigInteger('regiao_id')->unsigned();
            $table->string('delegado_id');
            $table->timestamps();

            $table->foreign('regiao_id')->references('id')->on('regioes');
            $table->foreign('cargo_id')->references('id')->on('cargos');
            $table->foreign('delegado_id')->references('id')->on('delegados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidatos');
    }
}
