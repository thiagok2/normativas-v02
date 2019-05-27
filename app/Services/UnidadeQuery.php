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

    public function evolucaoUnidadesConfirmadas6Meses(){
        $result = DB::select("SELECT trim(t.ano_mes) as ano_mes, trim(t.mes_ano_abrev) as mes_ano_abrev,
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

    public function evolucaoUnidadesConfirmadasPeriodo($dataInicio = null, $dataFim = null){
        $sql = "SELECT trim(t.ano_mes) as ano_mes, trim(t.mes_ano_abrev) as mes_ano_abrev,
            COUNT(DISTINCT(un2.id)) as criados,
            COUNT(DISTINCT(un.id)) as confirmados
            FROM tempo t
            LEFT OUTER JOIN unidades un on TO_CHAR(un.confirmado_em,'YYYYMM') = t.ano_mes
            LEFT OUTER JOIN unidades un2 on TO_CHAR(un2.created_at,'YYYYMM') = t.ano_mes
            WHERE t.data_atual >= '20181101' and t.data_atual < CURRENT_DATE ";

        if($dataInicio)
            $sql = $sql." and t.data_atual >= '".$dataInicio."'";
        
        if($dataFim)
            $sql = $sql." and t.data_atual <= '".$dataFim."'";

        $sql = $sql." GROUP BY t.ano_mes, t.mes_ano_abrev ORDER BY t.ano_mes";
        
        $result = DB::select( $sql );

        return $result;
    }

    public function documentosEtlPorStatus($unidadeId){
        $sql = "SELECT status_extrator as status, count(*) total from documentos
                WHERE tipo_entrada = 'extrator' and unidade_id = ? 
                GROUP BY status_extrator";

        $result = DB::select( $sql, [$unidadeId] );

        return $result;
    }
}