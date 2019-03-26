<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

class DocumentoQuery{

    public function evolucaoEnviados(){
        $result = DB::select("SELECT t.ano_mes, t.mes_ano_abrev,
        COUNT(DISTINCT(d.id)) as enviados
        FROM tempo t
        LEFT OUTER JOIN documentos d on TO_CHAR(d.data_envio,'YYYYMM') = t.ano_mes
        WHERE t.data_atual between '20181101' and CURRENT_DATE
        GROUP BY t.ano_mes, t.mes_ano_abrev
        ORDER BY t.ano_mes");

        return $result;
    }

    public function evolucaoEnviados6Meses(){
        $result = DB::select("SELECT t.ano_mes, t.mes_ano_abrev,
        COUNT(DISTINCT(d.id)) as enviados
        FROM tempo t
        LEFT OUTER JOIN documentos d on TO_CHAR(d.data_envio,'YYYYMM') = t.ano_mes
        WHERE (CURRENT_DATE - t.data_atual) between 0 and 180 and t.data_atual >= '20181101'
        GROUP BY t.ano_mes, t.mes_ano_abrev
        ORDER BY t.ano_mes");

        return $result;
    }

    public function countEnviados30dias(){
        $result = DB::select("SELECT
        COUNT(DISTINCT(d.id)) as enviados
        FROM tempo t
        LEFT OUTER JOIN documentos d on TO_CHAR(d.data_envio,'YYYYMM') = t.ano_mes
        WHERE (CURRENT_DATE - t.data_atual) between 0 and 30");

        return $result[0]->enviados;
    }

    public function documentosPorTipos(){
        $result = DB::select("SELECT 
            t.nome, 
            count(*) as total,
            (100*count(*)/(select count(t.id) from documentos d inner join tipo_documentos t on t.id = d.tipo_documento_id))as percent
        from documentos d
        inner join tipo_documentos t on t.id = d.tipo_documento_id
        group by t.nome
        limit 10
        ");

        return $result;
    }

    public function documentosPorAssuntos(){
        $result = DB::select("SELECT 
            a.nome, 
            count(*) as total,
            (100*count(*)/(select count(a.id) from documentos d inner join assuntos a on a.id = d.assunto_id))as percent
        from documentos d
            inner join assuntos a on a.id = d.assunto_id
        group by a.nome
        limit 10
        ");

        return $result;
    }
}