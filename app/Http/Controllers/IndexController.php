<?php

namespace App\Http\Controllers;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

use App\Models\Documento;
use Illuminate\Support\Facades\DB;

use App\Models\TipoDocumento;

class IndexController extends Controller
{
    const RESULTS_PER_PAGE = 5;

    /**
     * @var \Elasticsearch\Client
     */
    private $client;


    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $hosts = [        
            getenv('ELASTIC_URL')
        ];
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
    }

    public function index(Request $request)
    {

        //dd ($request->all());
        $variables = [];

        $queryArray = [
            'bool' => [
                "minimum_should_match"=> 1,
                'must' => [],
                'filter' => [],
                'should' => []
            ]
        ];

        $filters = false;

        $tipo_doc = $request->query("tipo_doc");
        $variables['tipo_doc'] = $tipo_doc;
        if(!empty($tipo_doc) && $tipo_doc != "all"){
            $queryArray['bool']['must'][] = [
                "term" => [
                    "ato.tipo_doc" => $tipo_doc
                ]
            ];

            $filters = true;
        }

        $esfera = $request->query("esfera");
        $variables['esfera'] = $esfera;
        if(!empty($esfera) && $esfera != "all"){
            $queryArray['bool']['must'][] = [
                "term" => [
                    "ato.fonte.esfera" => $esfera
                ]
            ];

            $filters = true;
        }

        /**Links agg*/
        $ano = $request->query("ano");
        $variables['ano'] = $ano;
        if(!empty($ano)){
            $queryArray['bool']['must'][] = [
                "term" => [
                    "ato.ano" => $ano
                ]
            ];
        }

         /**Links agg*/
         $fonte = $request->query("fonte");
         $variables['fonte'] = $fonte;
         if(!empty($fonte)){
             $queryArray['bool']['must'][] = [
                 "term" => [
                     "ato.fonte.sigla" => $fonte
                 ]
             ];
         }
        
        /**Menu */
        $periodo = $request->query("periodo");
        $variables['periodo'] = $periodo;
        if(!empty($periodo) && $periodo != "all"){
            $queryArray['bool']['must'][] = [
                "range" => [
                    "ato.ano" => [
                        "gte" => $periodo
                    ]
                ]
            ];

            $filters = true;
        }



        $variables['filters'] = $filters;

        if ($query = $request->query('query'))  {
            
            $query = trim($query);

            $page = $request->query('page', 1);
            $from = (($page - 1) * self::RESULTS_PER_PAGE);

            $variables['page'] = $page;
            $variables['from'] = $from;
             
            
            
            if($query){
                $variables['query'] = $query;
            

                $queryArray['bool']['should'][] = [
                    'match_phrase' => [
                        'ato.ementa' => [
                            'query' => $query,
                            'boost' => 1.5,
                            "slop" => 5
                        ]
                    ]
                ];

                $queryArray['bool']['should'][] = [
                    'match' => [
                        'ato.ementa' => [
                            'query' => $query,
                            'boost' => 1.5,
							"fuzziness" => "1",
                            "prefix_length" => 3
                        ]
                    ]
                ];
    
                $queryArray['bool']['should'][] = [
                    'match_phrase' => [
                        'ato.titulo' => [
                            'query' => $query,
                            'boost' => 1.5,
                            "slop" => 2
                        ]
                    ]
                ];
                $queryArray['bool']['should'][] = [         
                    'match_phrase' => [
                        'ato.tags' => [
                            'query' => $query,
                            'boost' => 1.5,
                            "slop" => 2
                        ]
                    ]
                ];

                $queryArray['bool']['should'][] = [         
                    'match' => [
                        'ato.tags' => [
                            'query' => $query,
                            'boost' => 1.5,
							"fuzziness" => "1",
                            "prefix_length" => 3
                        ]
                    ]
                ];
    
                $queryArray['bool']['should'][] = [  
                    'match_phrase' => [
                        'attachment.content' => [
                            'query' => $query,
                            'boost' => 1.25,
                            "slop" => 5
                        ]
                    ]
                ];

                $queryArray['bool']['should'][] = [  
                    'match' => [
                        'attachment.content' => [
                            'query' => $query,
                            'boost' => 1,
                            "fuzziness" => "1",
                            "prefix_length" => 3
                        ]
                    ]
                ];

            }       
        }

        $params = [
                
            'index' => 'normativas',
            'type' => '_doc',
            'body' => [
                'query' => $queryArray,
                'size' => self::RESULTS_PER_PAGE,
                'from' => isset($from) ? $from:0,
                '_source' => ['ato.*'],
                'highlight' => [
                    'encoder' => 'default',
                    'number_of_fragments' => 20,
                    'fragment_size' => 200,
                    'pre_tags' => ["<span class='highlight_word'>"],
                    'post_tags' => ["</span>"],
                    'fields' => [
                        'attachment.content' => new \stdClass()
                    ]
                ]
            ]
        ];


        if(isset($query) || isset($filtro)){

           
            $result = $this->client->search($params);

            //dd( $result);
            $total = $result['hits']['total'];
            $max_score = $result['hits']['max_score'];

            //$q = $query;
            $variables['page'] = $page;
            $variables['total'] = $total;
            $size_page = self::RESULTS_PER_PAGE;
            $total_pages = ceil($total/self::RESULTS_PER_PAGE);

            $max_score = $max_score;
    
    
            if (isset($result['hits']['hits'])) {
                //$variables['hits'] = $result['hits']['hits'];
                $hits = $result['hits']['hits'];
            }
        }

        $aggregations = $this->getSearchFilterAggregations($queryArray);


        $tiposDocumento = TipoDocumento::all();
       

        return view('index.index', compact('max_score'
        ,'tipo_doc','esfera','ano','fonte','periodo','filters',
        'page','from','query','q','page','total','size_page',
        'total_pages','hits','aggregations','tiposDocumento'));
        
    }

    // public function filter(Request $request)
    // {
    //     $variables = [];
    //     return view('index.index', $variables);
    // }

    public function pdfNormativa($normativaId)
    {
        $result = $this->client->get([
            'index' => 'normativas',
            'type' => '_doc',
            'id' => $normativaId
        ]);

        $base64 =  $result['_source']['data'];
        
        
        $data = base64_decode($base64);
        header('Content-Type: application/pdf');
        echo $data;
    }

    public function viewNormativa($normativaId)
    {
        $result = $this->client->get([
            'index' => 'normativas',
            'type' => '_doc',
            'id' => $normativaId
        ]);

        $resultsLikes = $this->likeDocuments($normativaId, "buscaa");

        if (isset($resultsLikes["hits"]["hits"])) {
            $documentsLikes["docs"] = $resultsLikes["hits"]["hits"];
        }
        
        return view('index.view-normativa', [ 'normativa' => $result['_source'], 'id' => $result['_id'], 'arquivoId' => $result['_id'],'documentsLikes' => $documentsLikes ] );
    }

    protected function getSearchFilterAggregations(array $queryArray)
    {
        $params = [
            'index' => 'normativas',
            'type' => '_doc',
            'body' => [
                'query' => $queryArray,
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

        return $this->client->search($params);
    }

    protected function likeDocuments($normatidaId, $q){
        $params = [
            "index" => "normativas",
            "type" => "_doc",
            "body" => [
                "_source" => [
                    "include" => [ "ato.*"]
                ],
                "size" => 6,
                "query" => [
                    "more_like_this" => [
                        "fields" => ["ato.ementa","ato.tags"],
                        "like" => [
                            [
                            "_index" => "normativas",
                            "_type" => "_doc",
                            "_id" => "CEMS_Del-9375-2010"
                            ],
                            "Avaliação Institucional"
                        ],
                        "min_term_freq" => 1,
                        "max_query_terms" => 15
                    ]
                ]
            ]
        ];

        return $this->client->search($params);

    }

    public function delete(Request $request){

        $arquivoId = $request->arquivoId;

        $doc = Documento::where('arquivo', $arquivoId)->first();
        if($doc)
            $doc->delete();

        $params = [
            'index' => 'normativas',
            'type'  => '_doc',
            'id'    => $arquivoId,
        ];
        
        $response = $this->client->delete($params);


        return redirect("/");
    }

   
} 