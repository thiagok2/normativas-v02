<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalavraChavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palavra_chaves', function (Blueprint $table) {
            $table->increments('id');

            $table->string('tag',20);

            $table->integer('documento_id')->unsigned();
            $table->foreign('documento_id')->references('id')->on('documentos');

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
        Schema::dropIfExists('palavra_chaves');
    }
}
