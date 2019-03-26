<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;


class UnidadeQuery{
    
    public function countUnidadeConfirmadas(){
        $result = DB::select("SELECT count(*) total FROM unidades un
        INNER JOIN users us ON us.id = un.responsavel_id
        WHERE us.confirmado = true");

        return $result[0]->total;
    }

    public function countUnidadeNaoConfirmadas(){
        $result = DB::select("SELECT count(*) as total FROM unidades un
        INNER JOIN users us ON us.id = un.responsavel_id
        WHERE us.confirmado = false");

        return $result[0]->total;
    }

    public function countUnidadeConfirmadasUltimos30dias(){
        $result = DB::select("SELECT 
            COUNT(DISTINCT(u.id)) as confirmadas
            FROM tempo t
            LEFT OUTER JOIN unidades u on TO_CHAR(u.confirmado_em,'YYYYMM') = t.ano_mes
            WHERE (CURRENT_DATE - t.data_atual) between 0 and 30");

        return $result[0]->confirmadas;
    }

    public function evolucaoUnidadesConfirmadas(){
        $result = DB::select("SELECT t.ano_mes, t.mes_ano_abrev,
            COUNT(DISTINCT(un2.id)) as criados,
            COUNT(DISTINCT(un.id)) as confirmados
            FROM tempo t
            LEFT OUTER JOIN unidades un on TO_CHAR(un.confirmado_em,'YYYYMM') = t.ano_mes
            LEFT OUTER JOIN unidades un2 on TO_CHAR(un2.created_at,'YYYYMM') = t.ano_mes
            WHERE (CURRENT_DATE - t.data_atual) between 0 and 180 and t.data_atual >= '20181101'
            GROUP BY t.ano_mes, t.mes_ano_abrev
            ORDER BY t.ano_mes");

        return $result;
    }
}