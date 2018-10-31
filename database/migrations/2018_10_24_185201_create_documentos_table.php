<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('ano');
            $table->string('titulo', 255);
            $table->string('numero', 20);
            $table->mediumText('ementa');
            $table->string('arquivo', 200);
            $table->string('url', 200)->nullable();
            $table->date('data_publicacao');
            $table->timestamp('data_envio')->useCurrent();

            $table->integer('acessos')->default(0);

            $table->integer('tipo_documento_id')->unsigned();
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documentos');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('assunto_id')->unsigned();
            $table->foreign('assunto_id')->references('id')->on('assuntos');

            $table->integer('unidade_id')->unsigned();
            $table->foreign('unidade_id')->references('id')->on('unidades');




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
        Schema::dropIfExists('documentos');
    }
}
