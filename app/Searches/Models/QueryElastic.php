<?php

namespace App\Searches\Models;

class QueryElastic
{

    protected $from;
    protected $queryArray;
    protected $root;
    protected $index;
    protected $size;

    function __construct($_queryArray, $_index, $_root, $_from = 0, $_size = 5) {
        $this->queryArray = $_queryArray;
    
        $this->index = $_index;
        $this->root = $_root;
        $this->from = $_from;
        $this->size = $_size;
    }

    public function get(){
        return [   
            'index' => $this->index,
            'type' => '_doc',
            'body' => [
                'min_score' => 0.5,
                'query' =>  $this->queryArray,
                'size' =>   $this->size,
                'from' => isset($this->from) ? $this->from : 0,
                '_source' => [$this->root.".*"],
                'highlight' => [
                    'encoder' => 'default',
                    'number_of_fragments' => 20,
                    'fragment_size' => 200,
                    'pre_tags' => ["<span class='highlight_word'>"],
                    'post_tags' => ["</span>"],
                    'fields' => [
                        'attachment.content' => [
                            "force_source"          => "true"
                        ]
                    ],
                    'require_field_match' => false
                ]
            ]
        ];
    }

    public function agg()
    {
        return [
            'index' => $this->index,
            'type' => '_doc',
            'body' => [
                'query' => $this->queryArray,
                'size' => 0,
                'aggs' => [
                    'ano' => [
                        'terms' => [ 'field' => 'ato.ano' ]
                    ],
                    'esfera' => [
                        'terms' => [ 'field' => 'ato.fonte.esfera' ]
                    ],
                    'fonte' => [
                        'terms' => [ 'field' => 'ato.fonte.sigla' ]
                    ]

                ]
            ]
        ];

        
    }



}