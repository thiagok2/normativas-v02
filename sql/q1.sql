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


select 
	t.nome, 
	count(*) as total,
	(100*count(*)/(select count(t.id) from documentos d inner join tipo_documentos t on t.id = d.tipo_documento_id))as percent
from documentos d
inner join tipo_documentos t on t.id = d.tipo_documento_id
group by t.nome


select 
	a.nome, 
	count(*) as total,
	(100*count(*)/(select count(a.id) from documentos d inner join assuntos a on a.id = d.assunto_id))as percent
from documentos d
inner join assuntos a on a.id = d.assunto_id
group by a.nome
limit 10

select 'atual' as periodo ,
count(*) as anterior from consultas
where (CURRENT_DATE - DATE(data_consulta)) between 0 and 30
union all
select 'anterior' as periodo ,
count(*) as anterior from consultas
where (CURRENT_DATE - DATE(data_consulta)) between 31 and 60










