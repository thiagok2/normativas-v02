<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddCapitalMunicipio extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('municipios')
            ->whereIn('codigo_ibge', ['1200401',
            '2704302',
            '1600303',
            '1302603',
            '2927408',
            '2304400',
            '5300108',
            '3205309',
            '5208707',
            '2111300',
            '5103403',
            '5002704',
            '3106200',
            '1501402',
            '2507507',
            '4106902',
            '2611606',
            '2211001',
            '3304557',
            '2408102',
            '4314902',
            '1100205',
            '1400100',
            '4205407',
            '3550308',
            '2800308',
            '1721000'])
            ->update(['capital' => true]);
    }
}
