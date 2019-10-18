<?php

namespace App\Services;

use App\Models\Unidade;
use Illuminate\Support\Facades\DB;



class UsuarioQuery{
    
    public function countAcessos30Dias(){
        $sql = "SELECT count(*) as total from users
        INNER JOIN unidades ON unidades.id = users.unidade_id
        where (CURRENT_DATE - DATE(ultimo_acesso_em)) between 0 and 30";

    if( auth()->user()->isAcessor()){
        $unidade = Unidade::find(auth()->user()->unidade_id);
        $sql = $sql." and un.estado_id = ".$unidade->estado_id;
    }
        
        $result = DB::select(
            $sql
        );
    
        return $result[0]->total;
    }
}