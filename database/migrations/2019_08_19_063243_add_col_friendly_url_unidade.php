<?php

use App\Models\Unidade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

class AddColFriendlyUrlUnidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unidades', function ($table) {
            $table->string('friendly_url',200)->nullable();
        });

        $unidades = Unidade::all();

        foreach($unidades as $u){
            $u->friendly_url = Str::slug($u->nome,'-');
            $u->save();
        }

        Schema::table('unidades', function ($table) {
            $table->string('friendly_url',200)->nullable(false)->change();
        });

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
