<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnEstadoStatusAcessoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estados', function ($table) {
            $table->boolean('possui_acessoria')->default(false);
        });

        DB::statement("UPDATE estados SET possui_acessoria = true WHERE (SELECT count(*) FROM unidades WHERE unidades.estado_id = estados.id and tipo = 'Acessoria' and esfera = 'Estadual' ) >= 1");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
