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
        $unidades = Unidade::where('tipo', '=', 'Conselho')
                ->where('esfera', '=', 'Estadual')
                ->get();

        foreach($unidades as $unidade){                                    
            User::create([
                'name' => "Robô extrator ".$unidade->sigla,
                'email' => "cee".strtolower(substr($unidade->sigla,-2))."@extrator.com.br",
                'password' => Hash::make('extrator'),
                'unidade_id' => $unidade->id,
                'tipo' => User::TIPO_EXTRATOR
            ]); 
        }
               
        /*
        $unidade = Unidade::where('sigla', "CEE-SP")->first();

        $usuarioRobo1 = User::create([
            'name' => "Robô extrator CEE-SP",
            'email' => "ceesp@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidade->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);
        

        $unidade = Unidade::where('sigla', "CEE-AL")->first();

        $usuarioRobo2 = User::create([
            'name' => "Robô extrator CEE-AL",
            'email' => "ceeal@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidade->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);

        $unidade = Unidade::where('sigla', "CEE-ES")->first();

        $usuarioRobo3 = User::create([
            'name' => "Robô extrator CEE-ES",
            'email' => "ceees@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidade->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);

        $unidade = Unidade::where('sigla', "CEE-MG")->first();

        $usuarioRobo4 = User::create([
            'name' => "Robô extrator CEE-MG",
            'email' => "ceemg@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidade->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);

        $unidade = Unidade::where('sigla', "CEE-DF")->first();

        $usuarioRobo5 = User::create([
            'name' => "Robô extrator CEE-DF",
            'email' => "ceedf@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidade->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);

        // Novos

        $unidade = Unidade::where('sigla', "CEE-CE")->first();

        $usuarioRobo = User::create([
            'name' => "Robô extrator CEE-CE",
            'email' => "ceece@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidade->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);        

        $unidade = Unidade::where('sigla', "CEED-RS")->first();

        $usuarioRobo = User::create([
            'name' => "Robô extrator CEED-RS",
            'email' => "ceers@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidade->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);

        $unidade = Unidade::where('sigla', "CEE-SE")->first();

        $usuarioRobo = User::create([
            'name' => "Robô extrator CEE-SE",
            'email' => "ceese@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidade->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);

        $unidade = Unidade::where('sigla', "CEE-PE")->first();

        $usuarioRobo = User::create([
            'name' => "Robô extrator CEE-PE",
            'email' => "ceepe@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidade->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);

        $unidade = Unidade::where('sigla', "CEE-MS")->first();

        $usuarioRobo = User::create([
            'name' => "Robô extrator CEE-MS",
            'email' => "ceems@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidade->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);

        $unidade = Unidade::where('sigla', "CEE-SC")->first();

        $usuarioRobo = User::create([
            'name' => "Robô extrator CEE-SC",
            'email' => "ceesc@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidade->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);

        $unidade = Unidade::where('sigla', "CEE-RO")->first();

        $usuarioRobo = User::create([
            'name' => "Robô extrator CEE-RO",
            'email' => "ceero@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidade->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);

        $unidade = Unidade::where('sigla', "CEE-PA")->first();

        $usuarioRobo = User::create([
            'name' => "Robô extrator CEE-PA",
            'email' => "ceepa@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidade->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);

        $unidade = Unidade::where('sigla', "CEE-PI")->first();

        $usuarioRobo = User::create([
            'name' => "Robô extrator CEE-PI",
            'email' => "ceepi@extrator.com.br",
            'password' => Hash::make('extrator'),
            'unidade_id' => $unidade->id,
            'tipo' => User::TIPO_EXTRATOR
        ]);           
        */     
    }
}
