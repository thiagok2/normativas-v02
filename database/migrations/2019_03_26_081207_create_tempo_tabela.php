<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTempoTabela extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE TABLE tempo
        (
        tempo_id              INT NOT NULL,
        data_atual              DATE NOT NULL,
        dia_nome                 VARCHAR(20) NOT NULL,
        dia_semana              INT NOT NULL,
        dia_mes             INT NOT NULL,
        dia_ano              INT NOT NULL,
        semana_mes            INT NOT NULL,
        semana_ano             INT NOT NULL,
        mes             INT NOT NULL,
        mes_nome               VARCHAR(20) NOT NULL,
        mes_nome_abrev   CHAR(10) NOT NULL,
        trimestre_atual           INT NOT NULL,
        trimestre_name             VARCHAR(20) NOT NULL,
        ano              INT NOT NULL,
        primeiro_dia_semana        DATE NOT NULL,
        ultimo_dia_semana         DATE NOT NULL,
        primeiro_dia_mes       DATE NOT NULL,
        ultimo_dia_mes        DATE NOT NULL,
        primeiro_dia_ano        DATE NOT NULL,
        ultimo_dia_ano         DATE NOT NULL,
        ano_mes                   CHAR(10) NOT NULL,
        mes_ano                   CHAR(10) NOT NULL,
        mes_ano_abrev			CHAR(20) NOT NULL,
        finaldesemana             BOOLEAN NOT NULL
        );
        ");

        DB::statement("
        ALTER TABLE public.tempo ADD CONSTRAINT tempo_tempo_id_pk PRIMARY KEY (tempo_id);
        ");

        DB::statement("
        CREATE INDEX tempo_data_atual_idx
        ON tempo(data_atual);
        ");

        DB::statement("
        INSERT INTO tempo
        SELECT TO_CHAR(datum,'yyyymmdd')::INT AS tempo_id,
            datum AS data_atual,
            TO_CHAR(datum,'TMDay') AS dia_nome,
            EXTRACT(isodow FROM datum) AS dia_semana,
            EXTRACT(DAY FROM datum) AS dia_mes,
            EXTRACT(doy FROM datum) AS dia_ano,
            TO_CHAR(datum,'W')::INT AS semana_mes,
            EXTRACT(week FROM datum) AS semana_ano,
            EXTRACT(MONTH FROM datum) AS mes,
            TO_CHAR(datum,'TMMonth') AS mes_nome,
            TO_CHAR(datum,'TMMon') AS mes_nome_abrev,
            EXTRACT(quarter FROM datum) AS trimestre_atual,
            CASE
                WHEN EXTRACT(quarter FROM datum) = 1 THEN '1º Trimestre'
                WHEN EXTRACT(quarter FROM datum) = 2 THEN '2º Trimestre'
                WHEN EXTRACT(quarter FROM datum) = 3 THEN '3º Trimestre'
                WHEN EXTRACT(quarter FROM datum) = 4 THEN '4º Trimestre'
            END AS trimestre_name,
            EXTRACT(year FROM datum) AS ano,
            datum +(1 -EXTRACT(isodow FROM datum))::INT AS primeiro_dia_semana,
            datum +(7 -EXTRACT(isodow FROM datum))::INT AS ultimo_dia_semana,
            datum +(1 -EXTRACT(DAY FROM datum))::INT AS primeiro_dia_mes,
            (DATE_TRUNC('MONTH',datum) +INTERVAL '1 MONTH - 1 day')::DATE AS ultimo_day_of_month,
            TO_DATE(EXTRACT(isoyear FROM datum) || '-01-01','YYYY-MM-DD') AS primeiro_dia_ano,
            TO_DATE(EXTRACT(isoyear FROM datum) || '-12-31','YYYY-MM-DD') AS ultimo_dia_ano,
            trim(TO_CHAR(datum,'yyyyMM')) AS ano_mes,
            trim(TO_CHAR(datum,'mm/yyyy')) AS mes_ano,
            trim(TO_CHAR(datum,'TMMon/yyyy')) AS mes_ano_abrev,
            CASE
                WHEN EXTRACT(isodow FROM datum) IN (6,7) THEN TRUE
                ELSE FALSE
            END AS finaldesemana
        FROM (SELECT '2015-01-01'::DATE+ SEQUENCE.DAY AS datum
            FROM GENERATE_SERIES (0,6000) AS SEQUENCE (DAY)
            GROUP BY SEQUENCE.DAY) DQ
        ORDER BY 1;

        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
