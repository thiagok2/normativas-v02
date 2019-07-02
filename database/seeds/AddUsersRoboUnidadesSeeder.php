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
            $usuarioRobo = User::where('tipo', User::TIPO_EXTRATOR)
                ->where('unidade_id', $unidade->id)->first();
            
            if(!$usuarioRobo){
                User::create([
                    'name' => "Robô extrator ".$unidade->sigla,
                    'email' => "cee".strtolower(substr($unidade->sigla,-2))."@extrator.com.br",
                    'password' => Hash::make('extrator'),
                    'unidade_id' => $unidade->id,
                    'tipo' => User::TIPO_EXTRATOR
                ]); 
            }
            
        }
               
        
    }
}
