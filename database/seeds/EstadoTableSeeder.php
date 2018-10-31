<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Estado;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->delete();
        Estado::create(['id' => 1, 'nome' => 'Acre', 'sigla' => 'AC']);
        Estado::create(['id' => 2, 'nome' => 'Alagoas', 'sigla' => 'AL']);
        Estado::create(['id' => 3, 'nome' => 'Amapá', 'sigla' => 'AP']);
        Estado::create(['id' => 4, 'nome' => 'Amazonas', 'sigla' => 'AM']);
        Estado::create(['id' => 5, 'nome' => 'Bahia', 'sigla' => 'BA']);
        Estado::create(['id' => 6, 'nome' => 'Ceará', 'sigla' => 'CE']);
        Estado::create(['id' => 7, 'nome' => 'Distrito Federal', 'sigla' => 'DF']);
        Estado::create(['id' => 8, 'nome' => 'Espírito Santo', 'sigla' => 'ES']);
        Estado::create(['id' => 9, 'nome' => 'Goiás', 'sigla' => 'GO']);
        Estado::create(['id' => 10, 'nome' => 'Maranhão', 'sigla' => 'MA']);
        Estado::create(['id' => 11, 'nome' => 'Mato Grosso', 'sigla' => 'MT']);
        Estado::create(['id' => 12, 'nome' => 'Mato Grosso do Sul', 'sigla' => 'MS']);
        Estado::create(['id' => 13, 'nome' => 'Minas Gerais', 'sigla' => 'MG']);
        Estado::create(['id' => 14, 'nome' => 'Pará', 'sigla' => 'PA']);
        Estado::create(['id' => 15, 'nome' => 'Paraíba', 'sigla' => 'PB']);
        Estado::create(['id' => 16, 'nome' => 'Paraná', 'sigla' => 'PR']);
        Estado::create(['id' => 17, 'nome' => 'Pernambuco', 'sigla' => 'PE']);
        Estado::create(['id' => 18, 'nome' => 'Piauí', 'sigla' => 'PI']);
        Estado::create(['id' => 19, 'nome' => 'Rio de Janeiro', 'sigla' => 'RJ']);
        Estado::create(['id' => 20, 'nome' => 'Rio Grande do Norte', 'sigla' => 'RN']);
        Estado::create(['id' => 21, 'nome' => 'Rio Grande do Sul', 'sigla' => 'RS']);
        Estado::create(['id' => 22, 'nome' => 'Rondônia', 'sigla' => 'RO']);
        Estado::create(['id' => 23, 'nome' => 'Roraima', 'sigla' => 'RR']);
        Estado::create(['id' => 24, 'nome' => 'Santa Catarina', 'sigla' => 'SC']);
        Estado::create(['id' => 25, 'nome' => 'São Paulo', 'sigla' => 'SP']);
        Estado::create(['id' => 26, 'nome' => 'Sergipe', 'sigla' => 'SE']);
        Estado::create(['id' => 27, 'nome' => 'Tocantins', 'sigla' => 'TO']);
    }

}
