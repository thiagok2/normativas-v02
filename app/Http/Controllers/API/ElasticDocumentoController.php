<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use App\Models\Documento;
use Illuminate\Support\Facades\Log;

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
        try{
           
            $documento = Documento::find( $documentoId );

            $bodyDocumentElastic = $documento->toElasticObject();
            $pathDocumento = 'uploads/'.$documento->arquivo;
            if(Storage::exists($pathDocumento)){
                $arquivoData = Storage::get($pathDocumento);
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
                    $documento->status_extrator = Documento::STATUS_EXTRATOR_FALHA_ELASTIC;
                }
            }else{
                $documento->status_extrator = Documento::STATUS_EXTRATOR_FALHA_DOWNLOAD;
                return response()->json(
                    array("message" => "Arquivo ".$documento->arquivo." não encontrado.")
                    , 500);
            }
           

            $documento->save();
            
            return response()->json($result, 200);
        }catch(\Exception $e){
            $documento->status_extrator = Documento::STATUS_EXTRATOR_FALHA_ELASTIC;
            $documento->save();
            
            Log::error('ElasticDocumentoController::indexar - message: ('.$e->getLine().') '. $e->getMessage());

            return response()->json(
                array(
                    'message' => $e->getMessage(), 
                    'trace' => $e->getTraceAsString(),
                    'code' => $e->getFile().'('.$e->getLine().')'
                    ) , 500);
        }
       
    }
}
