<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;



class UsuarioQuery{
    
    public function countAcessos30Dias(){
        $result = DB::select(
        "SELECT count(*) as total from users
        where (CURRENT_DATE - DATE(ultimo_acesso_em)) between 0 and 30"
        );
    
        return $result[0]->total;
    }
}