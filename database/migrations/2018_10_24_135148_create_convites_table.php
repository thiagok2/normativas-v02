<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convites', function (Blueprint $table) {
            $table->increments('id');

            $table->string('token',100);
            $table->string('contato',50)->nullable();
            $table->string('telefone',20)->nullable();
            $table->string('email',50);
            $table->string('destinatario',100)->nullable();
            $table->string('mensagem',200)->nullable()->nullable();
            $table->boolean('confirmado')->default(false);
            $table->dateTime('data_confirmacao')->nullable();

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('estado_id')->unsigned()->nullable();
            $table->foreign('estado_id')->references('id')->on('estados');

            $table->integer('municipio_id')->unsigned()->nullable();
            $table->foreign('municipio_id')->references('id')->on('municipios');

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
        Schema::dropIfExists('convites');
    }
}
