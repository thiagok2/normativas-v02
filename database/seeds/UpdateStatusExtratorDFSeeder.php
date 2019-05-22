<?php

use Illuminate\Database\Seeder;
use App\Models\Documento;

class UpdateStatusExtratorDFSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Documento::where('tipo_entrada', Documento::ENTRADA_EXTRATOR)->update(['completed' => true]);
    }
}
