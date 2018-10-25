<?php

use Illuminate\Database\Seeder;
use App\Assunto;
use Illuminate\Support\Facades\DB;

class AssuntoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assuntos')->delete();
        Assunto::create(['nome' => 'Educação Especial']);
        Assunto::create(['nome' => 'Educação a Distância']);
        Assunto::create(['nome' => 'Educação Profissional']);
        Assunto::create(['nome' => 'Educação de Jovens e Adultos']);

        Assunto::create(['nome' => 'Educação Superior']);
        Assunto::create(['nome' => 'Educação Básica']);

    }
}
