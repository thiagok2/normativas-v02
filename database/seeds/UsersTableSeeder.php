<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Thiago Araújo Silva de Oliveira',
            'email' => 'thiagok2@gmail.com',
            'password' => bcrypt('123456')
        ]);

        DB::table('users')->insert([
            'name' => 'Normativas',
            'email' => 'normativa@normativa.com',
            'password' => bcrypt('123456')
        ]);
    }
}
