<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkConviteMunicipioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('municipios', function (Blueprint $table) {
            $table->integer('convite_id')->unsigned()->nullable();
            $table->foreign('convite_id')->references('id')->on('convites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('municipios', function (Blueprint $table) {
            //
        });
    }
}
