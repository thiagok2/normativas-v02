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

            $this->addKeyValueAto( $doc , $hit, "id_persisted" );
            $this->addKeyValueAto( $doc , $hit, "numero" );
            $this->addKeyValueAto( $doc , $hit, "ano" );
            $this->addKeyValueAto( $doc , $hit, "tipo_doc" );
            $this->addKeyValueAto( $doc , $hit, "ementa" );
            $this->addKeyValueAto( $doc , $hit, "titulo" );
            
            $this->addKeyValueAto( $doc , $hit, "data_publicacao" );
            $this->addKeyValueAto( $doc , $hit, "url" );
            $this->addKeyValueAto( $doc , $hit, "tags" );


            if(array_key_exists( "data_envio" , $hit['_source']['ato'] ) 
                && array_key_exists( "date" , $hit['_source']['ato']['data_envio'])
                && isset($hit['_source']['ato']['data_envio'])){

                $doc['data_envio'] = $hit['_source']['ato']['data_envio']['date'];
            }else{
                $doc['data_envio'] = null;
            }
           

            $doc['fonte'] =  $hit['_source']['ato']['fonte'];

            if(array_key_exists( "attachment.content" , $hit['highlight'] ) && isset($hit['highlight']['attachment.content'])){
                $doc['trechos_destaque'] =  $hit['highlight']['attachment.content'];
            }else{
                $doc['trechos_destaque'] = null;
            }

            $this->documentsResult[] = $doc;
        }

        $this->aggResults = array();
        if(array_key_exists( "aggregations" , $elasticAggs )){
            foreach( $elasticAggs['aggregations'] as $aggKey => $aggVal){       
                $this->aggResults[$aggKey]["labels"] = array();
                
                foreach($aggVal["buckets"] as $bucket){
                    $this->aggResults[$aggKey]["labels"][] = ["nome" => $bucket["key"], "quantidade" => $bucket["doc_count"]];
                }            
            }
        }
        
    }

    private function addKeyValueAto(&$doc, $hit, $key){
        if(array_key_exists( $key , $hit['_source']['ato'] ) && isset($hit['_source']['ato'][$key])){
            $doc[$key] =  $hit['_source']['ato'][$key];
        }else{
            $doc[$key] = null;
        }

        return $doc;
    }
}
