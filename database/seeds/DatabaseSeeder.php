<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(EstadoTableSeeder::class);
       
        // $this->call(MunicipioTableSeeder::class);
        // $this->call(TipoDocumentoTableSeeder::class);
        // $this->call(AssuntoTableSeeder::class);
        // $this->call(UnidadeDefaultTableSeeder::class);
        // $this->call(UnidadeConselhosEstaduaisSeeder::class);
        // $this->call(UserConselhosEstaduaisSeeder::class);
        // $this->call(UserUnidadeConselhoFederalSeeder::class);

        // $this->call(AddAssuntoEducacaoInfantil::class);

        //$this->call(BrasilEstadoTableSeeder::class);

        //$this->call(AddAssuntoDesconhecidoSeeder::class);
        //$this->call(AddTipoDocumentoDesconhecidoSeeder::class);
        //$this->call(AddUsersRoboUnidadesSeeder::class);
        $this->call(TipoIndicacaoSPTipoDocumento::class);
        //$this->call(CreateCache::class);




   
    }
}
