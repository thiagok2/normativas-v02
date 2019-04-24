<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Models\Documento;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Storage;

class DocumentoService{
     /**
     * @var \Elasticsearch\Client
     */
    private $client;

    public function __construct()
    {

        $hosts = [        
            getenv('ELASTIC_URL')
        ];
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
    }

    public function delete($id)
    {
        $id = (int)$id;
        try{
            DB::beginTransaction();
            $documento = Documento::with('palavrasChaves')->find($id);

            if($documento->palavrasChaves)
                $documento->palavrasChaves()->delete();
            $documento->delete();

            Storage::delete("uploads/$documento->arquivo");
            
            DB::commit();

            return true;

        }catch(\Exception $e){
            return false;
        }
    }
}