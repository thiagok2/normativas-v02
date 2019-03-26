<?php

namespace App\Services;

use App\Models\Consulta;

class SearchComponent{
    public static function logging($termos){
        $consulta = new Consulta();
        $consulta->termos = $termos;
        $consulta->save();
    }

    
}