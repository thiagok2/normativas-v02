<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Unidade;
use Illuminate\Support\Str;

class FixFriendlyUrlUnidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $unidades = Unidade::all();

        foreach($unidades as $u){
            $u->friendly_url = Str::slug($u->sigla,'-');
            $u->save();
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