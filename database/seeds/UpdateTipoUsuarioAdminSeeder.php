<?php

use Illuminate\Database\Seeder;

class UpdateTipoUsuarioAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::where('tipo','administrador(a)')->update(['tipo' =>'admin']);
    }
}
