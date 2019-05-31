<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\TipoDocumento;

class AddInstrucaoPortariaTiposDocumentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        TipoDocumento::create(['nome' => 'Portaria','sigla' => 'POR', 'descricao' => '.']);
        TipoDocumento::create(['nome' => 'Instrução','sigla' => 'INSTR', 'descricao' => '.']);
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
