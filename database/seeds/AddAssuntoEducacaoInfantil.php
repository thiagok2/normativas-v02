<?php

use Illuminate\Database\Seeder;

class AddAssuntoEducacaoInfantil extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assuntos')->insert([
            'nome' => 'Educação Infantil'
        ]);
    }
}
