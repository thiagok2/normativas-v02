<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use App\Models\Documento;



class ElasticDocumentoController extends Controller
{
    /**
     * @var \Elasticsearch\Client
     */
    private $client;

    public function __construct(){

        $hosts = [        
            getenv('ELASTIC_URL')
        ];
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
    }

    public function indexar(Request $request, $documentoId){

        $documento = Documento::find( $documentoId );

        $bodyDocumentElastic = $documento->toElasticObject();
        $arquivoData = Storage::get('uploads/'.$documento->arquivo);
        $bodyDocumentElastic["data"] = base64_encode($arquivoData);

        $params = [
            'index' => 'normativas',
            'type'  => '_doc',
            'id'    => $documento->arquivo,
            'pipeline' => 'attachment', 
            'body'  => $bodyDocumentElastic
            
        ];

        $result = $this->client->index($params);

        if($result['result'] == 'created' || $result['result'] == 'updated'){
            $documento->status_extrator = Documento::STATUS_EXTRATOR_INDEXADO;
        }else{
            $documento->status_extrator = Documento::STATUS_EXTRATOR_FALHA;
        }
        $documento->save();
        
        return response()->json($result, 200);
    }
}
