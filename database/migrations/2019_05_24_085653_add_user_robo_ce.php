<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Unidade;
use App\User;

class AddUserRoboCe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $unidade = Unidade::where('sigla', "CEE-CE")->first();

        $usuarioRobo = User::create([
            'name' => "Robô extrator CEE-CE-".$unidade->id,
            'email' => "ceece@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidade->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);

        $usuarioRobo->unidade()->associate($unidade);
        $usuarioRobo->save();
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
