<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateCriadoMunicipioEstado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("UPDATE municipios SET criado = true WHERE (SELECT count(*) FROM unidades WHERE unidades.municipio_id = municipios.id and esfera = 'Municipal') >= 1;");
    
        DB::statement("UPDATE estados SET criado = true WHERE (SELECT count(*) FROM unidades WHERE unidades.estado_id = estados.id and esfera = 'Estadual') >= 1");
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
