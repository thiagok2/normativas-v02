<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CreateCache extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::create('cache', function ($table) {
            $table->string('key')->unique();
            $table->text('value');
            $table->integer('expiration');
        });
    }
}
