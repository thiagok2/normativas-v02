<?php

use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Unidade;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;


class LoadCSVUncmeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_n = Storage::disk('local')->path('uncme.csv');;
        $file = fopen($file_n, "r");
        $header = true;

        while ( ($data = fgetcsv($file, 0, ";")) !== FALSE ){
            if($header){
                $header = false;
            }else{
                $unidade = new Unidade();
                $unidade->user_id = 1;
                $unidade->esfera = Unidade::ESFERA_MUNICIPAL;
                $unidade->tipo = Unidade::TIPO_CONSELHO;
                $municipio_nome = $data[2];
                $uf = $data[3];

                $estado = Estado::where('sigla', $uf)->first();
                $municipio = Municipio::where([
                    ['estado_id',$estado->id],
                    ['nome','ILIKE',$municipio_nome]
                ])->first();

                if($municipio->criado)
                    continue;

                $unidade->estado()->associate($estado);
                $unidade->municipio()->associate($municipio);
                $unidade->nome = $data[4];
                $unidade->sigla = $data[5];
                $unidade->friendly_url = $data[6];
                $unidade->contato = $data[7];
                
                $unidade->email = 'alterar_email'.rand(10,99).'@cme-'.strtolower($this->retiraAcentos($data[6])).'.com.br';

                $gestorMunicipal = User::create([
                    'name' => 'Gestor '.$unidade->nome,
                    'email' => $unidade->email,
                    'password' => Hash::make('987654321'),
                    'tipo' => 'gestor'
                ]);

                $unidade->responsavel()->associate($gestorMunicipal);
                $unidade->save();
                $gestorMunicipal->unidade()->associate($unidade);
                $gestorMunicipal->save();

                $municipio->criado = true;
                $municipio->save();

            }
            
            
        }
        fclose($file);


    }

    function retiraAcentos($string){
        $acentos  =  'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $sem_acentos  =  'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $string = strtr($string, utf8_decode($acentos), $sem_acentos);
        return utf8_decode($string);
     }
}
