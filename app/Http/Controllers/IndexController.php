<?php

namespace App\Http\Controllers;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

use App\Models\Documento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\TipoDocumento;
use App\Services\SearchComponent;
use App\Searches\Commands\SearchCommandA1;

class IndexController extends Controller
{
    const RESULTS_PER_PAGE = 10;

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

        $size_page = $request->has('page_size') ? $request->query("page_size"): self::RESULTS_PER_PAGE;

        $tipo_doc = $request->query("tipo_doc");
        $esfera = $request->query("esfera");
        $periodo = $request->query("periodo");

        $ano = $request->query("ano");
        $fonte = $request->query("fonte");
        
        $tiposDocumento = TipoDocumento::has('documentos')->get();;
        $query = $request->query('query');

        $queryFilters = $request->query();
        $filters = $this->hasFilters($queryFilters);

        $documentos = [];

        //dd($query);
        try{
            if(isset($query)){
                $query = trim($query);

                SearchComponent::logging($query);

                $page = $request->query('page', 1);
                $from = (($page - 1) * $size_page);
 
                $searchCommand = new SearchCommandA1('normativas','ato');
                $result =  $searchCommand->search($query, $queryFilters, $from, $size_page);

                $total = $result->totalResults;
                $max_score = $result->maxScore;

                $total_pages = $result->totalPages;

                $documentos =  $result->documentsResult;
                $aggregations = $result->aggResults;
            }

            return view('index.index', compact('query',
            'tiposDocumento','tipo_doc','esfera','periodo',
            'ano','fonte','filters',
            'page','total','size_page','total_pages',
            'max_score','documentos','aggregations','message'));
       

        }catch(\Exception $e){          
            $erro['titulo'] = getenv('APP_DEBUG') ? "DEBUG:: ".$e->getMessage() : 'Plataforma de busca indisponível';
            $erro['local'] = $e->getFile()." #".$e->getLine();
            $erro['trace'] = $e->getTraceAsString();

            Log::error($e->getFile().' - Linha '.$e->getLine().' - search::'.$e->getMessage());
           
            throw  $e;

            // return view('index.index', compact('query','erro',
            // 'tiposDocumento','tipo_doc','esfera','periodo',
            // 'ano','fonte','filters',
            // 'page','total','size_page','total_pages',
            // 'max_score','documentos','aggregations','message'));
        }
        
    }

    public function viewNormativa($normativaId)
    {
        $result = $this->client->get([
            'index' => 'normativas',
            'type' => '_doc',
            'id' => $normativaId
        ]);

        $documento = Documento::where('arquivo', $normativaId)->first();

        $persisted = isset($documento);
        
        return view('index.view-normativa', [ 'normativa' => $result['_source'], 'id' => $result['_id'], 'arquivoId' => $result['_id'], 'persisted' => $persisted ] );
    }

    private function hasFilters($queryParams){
        foreach($queryParams as $q => $v){
            if(($q == "esfera" || $q == "periodo") && isset($v) && $v != "all"){
                return true;
            }
                
        }
    }

    protected function likeDocuments($docResult){
        
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
                            
                            $docResult['_source']['ato']['ementa']
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