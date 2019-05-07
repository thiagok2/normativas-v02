<?php

use Illuminate\Database\Seeder;
use App\Models\Assunto;

class AddAssuntoDesconhecidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assunto::create(['id' => 0, 'nome' => 'Assunto Desconhecido']);
    }
}
