<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\TipoDocumento;

class UpdateSiglasTipoDocumentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tiposDocumentos = TipoDocumento::all();

        foreach($tiposDocumentos as $t){
            if(!$t->sigla){
                $sigla1 = strtoupper(substr($t->nome,0,3));
               
                $t->sigla = $sigla1;
                $t->save();
            }
                
        }
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
