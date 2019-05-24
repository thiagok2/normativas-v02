<?php

use Illuminate\Database\Seeder;
use App\Models\TipoDocumento;

class AddTipoDocumentoPublicacao extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDocumento::create([
            'nome' => 'Publicação', 'descricao' => 'Tipo de documento muito utilizado no conselho de estadual de CE.', 
            'sigla' => 'PUB']);
    }
}
