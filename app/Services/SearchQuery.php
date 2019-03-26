<?php

namespace App\Services;

use App\Models\Consulta;
use Illuminate\Support\Facades\DB;


class SearchQuery{

    public function countQuery(){
        return Consulta::count();
    }

    public function countQuery3060Dias(){
        $result = DB::select(
        "SELECT 'atual' as periodo ,
        count(*) as total from consultas
        where (CURRENT_DATE - DATE(data_consulta)) between 0 and 30
        union all
        select 'anterior' as periodo ,
        count(*) as total from consultas
        where (CURRENT_DATE - DATE(data_consulta)) between 31 and 60");

        return $result;
    }

    public function topConsultas($limit){
        $result = DB::table('consultas')
                     ->select(DB::raw('count(*) as total, termos'))
                     ->groupBy('termos')
                     ->get();

        return $result;
    }
}