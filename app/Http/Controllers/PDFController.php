<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Elasticsearch\ClientBuilder;

class PDFController extends Controller
{

    private $client;

    public function __construct()
    {
        $hosts = [        
            getenv('ELASTIC_URL')
        ];
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
    }

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
}
