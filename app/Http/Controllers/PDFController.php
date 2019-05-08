<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Elasticsearch\ClientBuilder;
use App\Models\Documento;

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

        $documento = Documento::where('arquivo', $normativaId)->first();

        $result = $this->client->get([
            'index' => 'normativas',
            'type' => '_doc',
            'id' => $normativaId
        ]);

        $base64 =  $result['_source']['data'];
        
       
        $data = base64_decode($base64);

        if($documento->formato === 'pdf')
            header('Content-Type: application/pdf');
        elseif($documento->formato === 'doc')
            header('Content-Type: application/msword');
        elseif($documento->formato === 'docx')
            header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');    
        
        echo $data;
    }
}
