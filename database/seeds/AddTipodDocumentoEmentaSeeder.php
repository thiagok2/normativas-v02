<?php

use Illuminate\Database\Seeder;
use App\Models\TipoDocumento;

class AddTipodDocumentoEmentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoEmenta = TipoDocumento::where('nome', 'Ementa')->first();

        if(!$tipoEmenta){
            TipoDocumento::create(['nome' => 'Ementa', 'descricao' => '.', 'sigla' => 'EME']);
        }
    }
}
