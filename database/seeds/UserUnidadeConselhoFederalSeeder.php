<?php

use Illuminate\Database\Seeder;

use App\Models\Unidade;
use App\User;

class UserUnidadeConselhoFederalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unidade = Unidade::create([
            'nome' => 'CONSELHO NACIONAL DE EDUCAÇÃO – CNE', 
            'tipo' => 'Conselho', 
            'esfera' => 'Federal',
            'email' => 'cneagendamento@mec.gov.br',
            'url' => 'http://portal.mec.gov.br/cne',
            'sigla' => 'CNE',
            'contato' => 'PRESIDENTE: GILBERTO GONÇALVES GARCIA',
            'contato2' => 'SECRETÁRIO EXECUTIVO: ANDREA TAUIL OSLLEER MALAGUTTI',
            'endereco' => 'SGAS – Quadra 607/608 Av. L2 Sul. Lote 50 – Ed. Sede do CNE
            CEP: 70.200-670
            Brasília – DF', 
            'telefone' => '(61) 2022-7701',
            'user_id' => '1',
            'friendly_url' => 'cne',
            'confirmado' => false
        ]);

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
