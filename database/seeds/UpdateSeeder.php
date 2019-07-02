<?php

use Illuminate\Database\Seeder;

class UpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AddTipodDocumentoEmentaSeeder::class);
        $this->call(AddUsersRoboUnidadesSeeder::class);
    }
}
