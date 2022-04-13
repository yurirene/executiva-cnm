<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogImportacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_importacoes', function (Blueprint $table) {
            $table->id();
            $table->integer('sequencia');
            $table->string('codigo')->nullable();
            $table->string('nome')->nullable();
            $table->string('erro');
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
        Schema::dropIfExists('log_importacoes');
    }
}
