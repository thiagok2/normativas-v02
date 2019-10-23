<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Unidade;
use App\User;

class FixingUsuarioUncme extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        $gestorUncme = User::where('email', 'uncmenacional2018@gmail.com')->first();
        $uncme = Unidade::where('email', 'uncmenacional2018@gmail.com')->first();
        $gestorUncme->unidade()->associate($uncme);
        $gestorUncme->save();        
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
