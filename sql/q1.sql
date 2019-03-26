--Confirmados - INDICE
select count(*) from unidades un
inner join users us on us.id = un.responsavel_id
where us.confirmado = false;
--Not Confirmados - INDICE
select count(*) from unidades un
inner join users us on us.id = un.responsavel_id
where us.confirmado = true;

--Unidades confirmados - EVOLUÇÃO
SELECT t.ano_mes, t.mes_ano_abrev,
COUNT(DISTINCT(un2.id)) as criados,
COUNT(DISTINCT(un.id)) as confirmados
FROM tempo t
LEFT OUTER JOIN unidades un on TO_CHAR(un.confirmado_em,'YYYYMM') = t.ano_mes
LEFT OUTER JOIN unidades un2 on TO_CHAR(un2.created_at,'YYYYMM') = t.ano_mes
WHERE (CURRENT_DATE - t.data_atual) between 0 and 180 and t.data_atual >= '20181101'
GROUP BY t.ano_mes, t.mes_ano_abrev
ORDER BY t.ano_mes;

--CONFIRMADO ultimos 30 dias - INDICE
SELECT
COUNT(DISTINCT(u.id)) as confirmadas
FROM tempo t
LEFT OUTER JOIN unidades u on TO_CHAR(u.confirmado_em,'YYYYMM') = t.ano_mes
WHERE (CURRENT_DATE - t.data_atual) between 0 and 30



--Enviados mes a mes - desde o inicio - EVOLUÇÃO
SELECT t.ano_mes, t.mes_ano_abrev,
COUNT(DISTINCT(d.id)) as enviados
FROM tempo t
LEFT OUTER JOIN documentos d on TO_CHAR(d.data_envio,'YYYYMM') = t.ano_mes
WHERE t.data_atual between '20181101' and CURRENT_DATE
GROUP BY t.ano_mes, t.mes_ano_abrev
ORDER BY t.ano_mes;

--Enviados mes a mes - last 6 meses - EVOLUÇÃO
SELECT t.ano_mes, t.mes_ano_abrev,
COUNT(DISTINCT(d.id)) as enviados
FROM tempo t
LEFT OUTER JOIN documentos d on TO_CHAR(d.data_envio,'YYYYMM') = t.ano_mes
WHERE (CURRENT_DATE - t.data_atual) between 0 and 180 and t.data_atual >= '20181101'
GROUP BY t.ano_mes, t.mes_ano_abrev
ORDER BY t.ano_mes;

--Enviados ultimos 30 dias - INDICE
SELECT
COUNT(DISTINCT(d.id)) as enviados
FROM tempo t
LEFT OUTER JOIN documentos d on TO_CHAR(d.data_envio,'YYYYMM') = t.ano_mes
WHERE (CURRENT_DATE - t.data_atual) between 0 and 30









