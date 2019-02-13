<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

use App\Models\Documento;
use Illuminate\Support\Facades\DB;


class ElasticController extends Controller
{
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

    public function documentostest(){

        $params = [
                
            'index' => 'normativas',
            'type' => '_doc',
            'body' => [
                'size' => 25,
                'from' => isset($from) ? $from:0,
                '_source' => ['ato.*']
            ]
        ];

        $result = $this->client->search($params);

        $documentos = $result['hits']['hits'];

        $documentostest = [];

        foreach ($documentos as $doc) {

            Documento::where('arquivo', $doc->arquivo)->first();
        }
        
    }
}
