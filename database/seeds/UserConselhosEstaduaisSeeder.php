<?php

use Illuminate\Database\Seeder;

use App\Models\Unidade;
use App\User;

use Illuminate\Support\Facades\Hash;

class UserConselhosEstaduaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unidades = Unidade::whereNull('responsavel_id')
                ->where('tipo', '=', 'Conselho')
                ->where('esfera', '=', 'Estadual')
                ->get();

        foreach($unidades as $unidade){
            $email = trim(explode(";",$unidade->email)[0]);
            $nome = $unidade->nome;
            $senha = Hash::make('123456') ;

            $user = User::create([
                'name' => $nome,
                'email' => $email,
                'password' => $senha,
                'unidade_id' => $unidade->id,
                'tipo' => 'gestor'
            ]);

            $unidade->responsavel()->associate($user);

            $unidade->save();

        }

                
    }
}
