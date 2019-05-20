<?php

use Illuminate\Database\Seeder;
use App\Models\TipoDocumento;

class TipoIndicacaoSPTipoDocumento extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDocumento::create([
            'nome' => 'Indicação', 'descricao' => 'Tipo de documento muito utilizado no conselho de estadual de SP.', 
            'sigla' => 'INDI']);
    }
}
