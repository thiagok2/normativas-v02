<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class SeedCapitalUnidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('db:seed', [
            '--class' => AddCapitalMunicipio::class
        ]);

        Artisan::call('db:seed', [
            '--class' => UnidadesConselhosMunicipaisCapitaisSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /**
         * 
         * UPDATE unidades set responsavel_id = null where id >= 108;
         * DELETE FROM users WHERE id >= 160;
         * DELETE FROM unidades where id >= 108;
         * select * from unidades where responsavel_id is null;
         */
    }
}
