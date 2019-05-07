<?php

use Illuminate\Database\Seeder;
use App\Models\TipoDocumento;

class AddTipoDocumentoDesconhecidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDocumento::create([
            'id'=>0,
            'nome' => 'Indeterminado', 'descricao' => 'Tipo de documento não informado ou indeterminado', 
            'sigla' => 'NI']);
    }
}
