<?php

namespace App\Searches\Commands;

use App\Searches\Queries\QueryBuilder;
use App\Searches\Models\QueryElastic;
use Elasticsearch\ClientBuilder;
use App\Searches\Models\SearchResult;


class SearchCommandA1 implements ISearchCommand
{

    protected $queryBuilder;

    private $filters;
    private $query;

    private $index;
    private $root;

    private $clientElastic;

    function __construct($_index, $_root) {
        $this->index = $_index;
        $this->root =  $_root;

        $this->queryBuilder = new QueryBuilder("ato");

        $hosts = [        
            getenv('ELASTIC_URL')
        ];
        
        $this->clientElastic = ClientBuilder::create()->setHosts($hosts)->build();
    }

    public function getArrayQuery(){
        return $this->queryBuilder->getQueryArray();
    }
   
    public function search($query, $filters, $from, $sizePage){

        $this->addBoolShouldExpressions($query);
        $this->addBoolFilterExpressions($filters);

        $queryElastic = new QueryElastic(
                $this->queryBuilder->getQueryArray(), 
                $this->index,
                $this->root,
                $from,
                $sizePage
        );

        $elasticResult = $this->clientElastic->search($queryElastic->get());

        $aggs = $this->clientElastic->search($queryElastic->agg());

        $result = new SearchResult($elasticResult, $sizePage, $aggs);


        return $result;

    }

    private function checkHasFilter($filter, $arrayFilters){
        return array_key_exists($filter,$arrayFilters) 
                        && $arrayFilters[$filter]!= "all" && isset($arrayFilters[$filter]);
    }

    private function addBoolShouldExpressions($query){
        $this->queryBuilder
            ->addBoolShouldMatchPhrase($query,"ementa",1.5, 5)
            ->addBoolShouldMatchFuzziness($query, "ementa", 1.5, 1, 3)
            ->addBoolShouldMatchPhrase($query, "titulo", 1.5, 2)
            ->addBoolShouldMatchPhrase($query, "tags", 1.5, 2)
            ->addBoolShouldMatchFuzziness($query, "tags", 1.5, 1, 3)
            ->addBoolShouldMatchPhraseAttach($query, 1.25, 5)
            ->addBoolShouldMatchFuzzinessAttach($query, 1, "1",  3);

    }

    private function addBoolFilterExpressions($filters){
        if($this->checkHasFilter("tipo_doc", $filters))
            $this->queryBuilder->addBoolFilterTerm($filters["tipo_doc"], "tipo_doc");
        
        
        if($this->checkHasFilter("esfera", $filters))
            $this->queryBuilder->addBoolFilterTerm($filters["esfera"], "fonte.esfera");
            

        if($this->checkHasFilter("ano", $filters))
            $this->queryBuilder->addBoolFilterTerm($filters["ano"], "ano");
        
            
        if($this->checkHasFilter("fonte", $filters))
            $this->queryBuilder->addBoolFilterTerm($filters["fonte"], "fonte.sigla");
            

        if($this->checkHasFilter("periodo", $filters))
            $this->queryBuilder->addBoolFilterGte($filters["periodo"], "ano");
        

    }

    private function addBoolMustExpressions($filters){
       
        if($this->checkHasFilter("tipo_doc", $filters))
            $this->queryBuilder = $this->queryBuilder->addBoolMustTerm($filters["tipo_doc"], "tipo_doc");
           
        
        if($this->checkHasFilter("esfera", $filters))
            $this->queryBuilder->addBoolMustTerm($filters["esfera"], "fonte.esfera");
            

        if($this->checkHasFilter("ano", $filters))
            $this->queryBuilder->addBoolMustTerm($filters["ano"], "ano");
        
            
        if($this->checkHasFilter("fonte", $filters))
            $this->queryBuilder->addBoolMustTerm($filters["fonte"], "fonte.sigla");
            

        if($this->checkHasFilter("periodo", $filters))
            $this->queryBuilder->addBoolMustGte($filters["periodo"], "ano");
            
        dd($this->queryBuilder->toString());

    }

   

}