<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelegadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delegados', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('nome', 100);
            $table->string('codigo',20)->unique();
            $table->string('federacao',100);
            $table->string('sinodal',100);
            $table->string('estado');
            $table->string('foto')->nullable();
            $table->bigInteger('regiao_id')->unsigned();
            $table->foreign('regiao_id')->references('id')->on('regioes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delegados');
    }
}
