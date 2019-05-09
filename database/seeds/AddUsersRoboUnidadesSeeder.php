<?php

use Illuminate\Database\Seeder;
use App\Models\Unidade;
use App\User;

class AddUsersRoboUnidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $unidadeSP = Unidade::where('sigla', "CEE-SP")->first();

        $usuarioRobo = User::create([
            'name' => "Robô extrator CEE-SP",
            'email' => "ceesp@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidadeSP->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);
        

        $unidadeAL = Unidade::where('sigla', "CEE-AL")->first();

        $usuarioRobo = User::create([
            'name' => "Robô extrator CEE-AL",
            'email' => "ceeal@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidadeAL->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);


    }
}
