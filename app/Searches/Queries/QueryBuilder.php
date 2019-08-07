<?php

namespace App\Searches\Queries;

class QueryBuilder implements IQueryBuilder
{

    protected $queryArray;

    protected $root;


    public function getQueryArray(){
        return $this->queryArray;
    }
    
    function __construct($_root) {
        $this->queryArray =  [
            'bool' => [
                "minimum_should_match"=> 1,
                'must' => [],
                'filter' => [],
                'should' => []
            ]
        ];

        $this->root = $_root;
    }

    private function field($field){
        return $this->root.'.'.$field;
    }

    public function addBoolShouldMatchPhrase($q, $campo, $boost=1, $slop=2){
        $this->queryArray['bool']['should'][] = [
            'match_phrase' => [
                $this->field($campo) => [
                    'query' => $q,
                    'boost' => $boost,
                    "slop" => $slop
                ]
            ]
        ];

        return $this;

    }

    public function addBoolShouldMatchPhraseAttach($q, $boost=1, $slop=2){
        $this->queryArray['bool']['should'][] = [
            'match_phrase' => [
                'attachment.content' => [
                    'query' => $q,
                    'boost' => $boost,
                    "slop" => $slop
                ]
            ]
        ];

        return $this;

    }

    public function addBoolShouldMatchFuzziness($q, $campo, $boost=1, $fuzziness="1", $prefix_length=3){

        $this->queryArray['bool']['should'][] = [
            'match' => [
                $this->field($campo) => [
                    'query' => $q,
                    'boost' => $boost,
                    "fuzziness" => $fuzziness,
                    "prefix_length" => $prefix_length
                ]
            ]
        ];

        return $this;

    
    }

    public function addBoolShouldMatchFuzzinessAttach($q, $boost=1, $fuzziness="1", $prefix_length=3){

        $this->queryArray['bool']['should'][] = [
            'match' => [
                'attachment.content' => [
                    'query' => $q,
                    'boost' => $boost,
                    "fuzziness" => $fuzziness,
                    "prefix_length" => $prefix_length
                ]
            ]
        ];

        return $this;
    }

    public function addBoolFilterTerm($q, $campo){
        $this->queryArray['bool']['filter'][] = [
            "term" => [
                $this->field($campo) => $q
            ]
        ];

        return $this;
    }

    public function addBoolFilterGte($q, $campo){
        $this->queryArray['bool']['filter'][] = [
            "range" => [
                $this->field($campo) => [
                    "gte" => $q
                ]
            ]
        ];

        return $this;

    }

    public function addBoolFilterLte($q, $campo){
        $this->queryArray['bool']['filter'][] = [
            "range" => [
                $this->field($campo) => [
                    "lte" => $q
                ]
            ]
        ];

        return $this;

    }

    public function addBoolMustTerm($q, $campo){
        $this->queryArray['bool']['must'][] = [
            "term" => [
                $this->field($campo) => $q
            ]
        ];

        return $this;

    }

    public function addBoolMustGte($q, $campo){
        $this->queryArray['bool']['must'][] = [
            "range" => [
                $this->field($campo) => [
                    "gte" => $q
                ]
            ]
        ];

        return $this;

    }

    public function addBoolMustLte($q, $campo){
        $this->queryArray['bool']['must'][] = [
            "range" => [
                $this->field($campo) => [
                    "lte" => $q
                ]
            ]
        ];

        return $this;

    }

    public function toString(){
        return $this->queryArray;
    }
    
}