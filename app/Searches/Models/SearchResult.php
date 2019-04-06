<?php

namespace App\Searches\Models;

class SearchResult
{
    public $documentsResult;
    public $totalResults;
    public $maxScore;
    public $totalPages;

    public $aggResults;

    function __construct($elasticResult, $sizePage, $elasticAggs){
        $this->totalResults = $elasticResult['hits']['total'];
        $this->maxScore = $elasticResult['hits']['max_score'];
        $this->totalPages = ceil($this->totalResults/$sizePage);

        foreach($elasticResult['hits']['hits'] as $hit){
            $doc = array();
            $doc['id'] = $hit['_id'];
            $doc['score'] = $hit['_score'];

            if(array_key_exists( "id_persisted" , $hit['_source']['ato'] ) && isset($hit['_source']['ato']['id_persisted']))
                $doc['id_persisted'] = $hit['_source']['ato']['id_persisted'];
            
            
            $doc['ano'] = $hit['_source']['ato']['ano'];

            $doc['tipo_doc'] = $hit['_source']['ato']['tipo_doc'];
            $doc['ementa'] = $hit['_source']['ato']['ementa'];
            $doc['titulo'] = $hit['_source']['ato']['titulo'];

            $doc['data_publicacao'] = $hit['_source']['ato']['data_publicacao'];
            $doc['data_envio'] = $hit['_source']['ato']['data_envio']['date'];
            $doc['url'] = $hit['_source']['ato']['url'];
            
            $doc['tags'] =  $hit['_source']['ato']['tags'];

            $doc['fonte'] =  $hit['_source']['ato']['fonte'];

            if(array_key_exists( "attachment.content" , $hit['highlight'] ) && isset($hit['highlight']['attachment.content']))
                $doc['trechos_destaque'] =  $hit['highlight']['attachment.content'];

            $this->documentsResult[] = $doc;
        }

        $this->aggResults = array();
        foreach( $elasticAggs['aggregations'] as $aggKey => $aggVal){       
            $this->aggResults[$aggKey]["labels"] = array();
            
            foreach($aggVal["buckets"] as $bucket){
                $this->aggResults[$aggKey]["labels"][] = ["nome" => $bucket["key"], "quantidade" => $bucket["doc_count"]];
            }            
        }

    }



}
