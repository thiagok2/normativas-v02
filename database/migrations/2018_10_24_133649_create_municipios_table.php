<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome');
            $table->string('codigo_ibge', 20)->nullable();
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('estados');

            //$table->integer('convite_id')->unsigned()->nullable();
            //$table->foreign('convite_id')->references('id')->on('convites');

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
        Schema::dropIfExists('municipios');
    }
}
