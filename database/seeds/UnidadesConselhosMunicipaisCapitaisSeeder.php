<?php

use App\Models\Municipio;
use App\Models\Unidade;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UnidadesConselhosMunicipaisCapitaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $capitais = Municipio::where('capital',true)->with('estado')->get();

        foreach($capitais as $capital){

            $nome_slug = Str::slug($capital->nome, '-');

            $unidadeCapital = Unidade::create([
                'nome' => 'CONSELHO MUNICIPAL DE EDUCAÇÃO DE '.strtoupper($capital->nome), 
                'tipo' => 'Conselho', 
                'esfera' => 'Municipal',
                'email' => $nome_slug.'@'.$nome_slug.'.com',
                'url' => null,
                'sigla' => 'CME-'.strtoupper($nome_slug),
                'user_id' => '1',
                'estado_id' => $capital->estado->id,
                'municipio_id' => $capital->id,
                'friendly_url' => strtolower('CME-'.Str::slug($capital->nome, '-')),
                'confirmado' => false
            ]);

           
            $gestorCapital = User::create([
                'name' => 'Gestor '.$unidadeCapital->nome,
                'email' => $unidadeCapital->email,
                'password' => Hash::make('987654321'),
                'unidade_id' => $unidadeCapital->id,
                'tipo' => 'gestor'
            ]);

            $unidadeCapital->responsavel()->associate($gestorCapital);
            $unidadeCapital->save();
            
        }
    }
}