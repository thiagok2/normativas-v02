<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConfirmationEmUnidadeUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unidades', function ($table) {
            $table->dateTime('confirmado_em')->nullable();
        });

        Schema::table('users', function ($table) {
            $table->dateTime('confirmado_em')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unidades', function($table) {
            $table->dropColumn('confirmado_em');
        });

        Schema::table('users', function($table) {
            $table->dropColumn('confirmado_em');
        });
    }
}
