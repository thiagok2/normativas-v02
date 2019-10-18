<?php

use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Unidade;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsuarioUnidadeUncme extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admin = User::find(1);
        $sergipe = Estado::where('sigla', 'SE')->first();
        $aracaju = Municipio::where(
            [
                ['estado_id', $sergipe->id],
                ['capital', true]
            ]
        )->first();

        
        $uncme = new Unidade();
        $uncme->nome = 'União Nacional dos Conselhos Municipais de Educação';
        $uncme->tipo = Unidade::TIPO_ACESSORIA;
        $uncme->esfera = Unidade::ESFERA_FEDERAL;
        $uncme->email = 'uncmenacional2018@gmail.com';
        $uncme->sigla = 'UNCME';
        $uncme->friendly_url = 'uncme';
        $uncme->telefone = '(079)3248-6331';
        $uncme->confirmado = false;

        $uncme->user()->associate($admin);
        $uncme->estado()->associate($sergipe);
        $uncme->municipio()->associate($aracaju);

        $gestorUncme = User::create([
            'name' => 'Gestor '.$uncme->nome,
            'email' => $uncme->email,
            'password' => Hash::make('987654321'),
            'unidade_id' => $uncme->id,
            'tipo' => User::TIPO_ACESSOR
        ]);

        $uncme->responsavel()->associate($gestorUncme);
        $uncme->save();
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
