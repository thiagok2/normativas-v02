<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TipoDocumento;
use App\Models\Assunto;
use App\Models\Documento;
use App\Models\PalavraChave;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\DocumentoResquest;
use Illuminate\Support\Facades\Storage;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class DocumentoController extends Controller
{

    /**
     * @var \Elasticsearch\Client
     */
    private $client;

    /**
     * @param Client $client
    */
    public function __construct()
    {
        $hosts = [
            'https://elastic:43YSKv29RNRURDa6XqR3H90n@ba1e2a5961a84002bde6223cdd16d822.sa-east-1.aws.found.io:9243'
        
        ];
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
    }


    public function index(){

        $documentos = Documento::with('tipoDocumento','user')->simplePaginate(20);

        return view('admin.documento.index', compact('documentos'));
    }

    public function create(){

        $unidade = auth()->user()->unidade;

        $tiposDocumento = TipoDocumento::all();
        $assuntos = Assunto::all();  

        return view('admin.documento.create', compact('unidade','tiposDocumento',  'assuntos'));
    }

    public function store(DocumentoResquest $request, Documento $documento){

        try{
            $data= $request->all();
         
            $documento = new Documento();
            $documento->fill($data);

            $documento->data_envio = new \DateTime();

            $documento->unidade()->associate(auth()->user()->unidade);
            $documento->user()->associate(auth()->user()->id);
    
            if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
    
                DB::beginTransaction();
    
                $tituloArquivo = str_replace(" ","",strtolower(preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($documento->numero)))));
                $tituloArquivo = $tituloArquivo."_".uniqid(date('HYmd'));
    
                $extensao = $request->arquivo->extension();
                $arquivoNome = "{$tituloArquivo}.{$extensao}";
                $upload = $request->arquivo->storeAs('uploads', $arquivoNome);
                $documento->arquivo = $arquivoNome;
                $documento->save();
    
                $tags = explode(",", $data["palavras_chave"]);
                if(is_array($tags) && count($tags)>0){
                    foreach ($tags as $t) {
                        $palavra = new PalavraChave();
                        $palavra->tag = $t;
    
                        $palavra->documento()->associate($documento);
                        $documento->palavrasChaves()->save($palavra);
                    }
                }

                $bodyDocumentElastic = $documento->toElasticObject();
                $params = [
                    'index' => 'normativas',
                    'type'  => '_doc',
                    'id'    => $documento->numero,
                    'pipeline' => 'attachment', 
                    'body'  => $bodyDocumentElastic
                    
                ];

                $resultElastic = $this->client->index($params);

                //dd($resultElastic);

                DB::commit();

                //dd($resultElastic);

                return redirect()->route('documento', ['id' => $documento->id])
                    ->with('success', 'Documento enviado com sucesso.');
    
            }else{
                return redirect()
			    ->back()
			    ->with('error', "Insira um anexo de extensão PDF.");
            }


    
            

        }catch(\Exception $e){

            DB::rollBack();
            
            return redirect()
			    ->back()
			    ->with('error', $e->getMessage());
        }
    }

    public function show($id){
        $documento = Documento::with(['unidade','tipoDocumento','assunto','palavrasChaves'])->find($id);

        $elasticObject = $documento->toElasticObject();
        return view('admin.documento.show',compact('documento','elasticObject'));
    }

    public function destroy($id)
    {
        $documento = Documento::with('palavrasChaves')->find($id);

        $documento->palavrasChaves()->delete();
        $documento->delete();

        Storage::delete("uploads/$documento->arquivo");

        $params = [
            'index' => 'normativas',
            'type'  => '_doc',
            'id'    => $documento->numero,
        ];
        
        // Delete doc at /my_index/my_type/my_id
        $response = $this->client->delete($params);


        return redirect()->route('documentos')
            ->with('success', 'Documento removido com sucesso.');


    }

}
