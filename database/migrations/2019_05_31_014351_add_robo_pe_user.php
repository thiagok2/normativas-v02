<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;
use App\Models\Unidade;

class AddRoboPeUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $unidade = Unidade::where('sigla', "CEE-PE")->first();

        $usuarioRobo = User::create([
            'name' => "Robô extrator CEE-PE",
            'email' => "ceepe@extrator.com.br",
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
