<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrnaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urna', function (Blueprint $table) {
            $table->id();
            $table->uuid('eleitor');
            $table->uuid('candidato');
            $table->bigInteger('andamento')->unsigned();
            $table->foreign('andamento')->references('id')->on('andamentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('urnas');
    }
}
