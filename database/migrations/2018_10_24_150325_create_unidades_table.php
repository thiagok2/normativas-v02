<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome', 150);
            $table->string('tipo', 20);
            $table->string('esfera', 20);
            $table->string('sigla', 10);
            $table->string('url', 150)->nullable();
            $table->string('email', 100);
            $table->string('contato', 100)->nullable();
            $table->string('telefone', 100)->nullable();;

            $table->integer('responsavel_id')->unsigned();
            $table->foreign('responsavel_id')->references('id')->on('users');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('unidades');
    }
}
