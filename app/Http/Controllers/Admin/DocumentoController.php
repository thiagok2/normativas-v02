<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\TipoDocumento;
use App\Models\Assunto;
use App\Models\Documento;
use App\Models\PalavraChave;
use Illuminate\Support\Facades\DB;
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
            getenv('ELASTIC_URL')
        ];
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
    }


    public function index(){
        $unidade = auth()->user()->unidade;

        $documentos = Documento::with('tipoDocumento','user')
            ->where('unidade_id',$unidade->id)
            ->simplePaginate(10);

        return view('admin.documento.index', compact('documentos'));
    }

    public function create(){

        $unidade = auth()->user()->unidade;

        $tiposDocumento = TipoDocumento::all();

        $assuntos = Assunto::all(); 

        //$message = "Acesse: ".env('ELASTIC_URL');

        return view('admin.documento.create', compact('unidade','tiposDocumento',  'assuntos'));
    }

    public function store(Request $request, Documento $documento){

        try{

            $validator = Validator::make($request->all(), $documento->rules, $documento->messages);
             
            if ($validator->fails()) {
                 return redirect()->back()->withErrors($validator)->withInput();
            }

            $data= $request->all();
         
            $documento = new Documento();
            $documento->fill($data);

            $documento->data_envio = new \DateTime();

            $documento->unidade()->associate(auth()->user()->unidade);
            $documento->user()->associate(auth()->user()->id);
    
            if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
    
                DB::beginTransaction();
    
                //$extensao = $request->arquivo->extension();
                //$arquivoNome = "{$tituloArquivo}.{$extensao}";
               
                /**url amigável para arquivo */
                $urlArquivo = $documento->urlizer($documento->unidade->sigla."_".$documento->numero);

                $urlArquivo = $urlArquivo."_".uniqid().".pdf";
                $documento->arquivo = $urlArquivo;

                $upload = $request->arquivo->storeAs('uploads', $urlArquivo);

                $documento->save();
    
                $tags = explode(",", $data["palavras_chave"]);
                if(is_array($tags) && count($tags)>0){
                    foreach ($tags as $t) {
                        $palavra = new PalavraChave();
                        $palavra->tag = substr($t,0,100);
    
                        $palavra->documento()->associate($documento);
                        $documento->palavrasChaves()->save($palavra);
                    }
                }

                $bodyDocumentElastic = $documento->toElasticObject();
                $arquivoData = file_get_contents($request["arquivo"]);
                $bodyDocumentElastic["data"] = base64_encode($arquivoData);

                $params = [
                    'index' => 'normativas',
                    'type'  => '_doc',
                    'id'    => $documento->arquivo,
                    'pipeline' => 'attachment', 
                    'body'  => $bodyDocumentElastic
                    
                ];

                $resultElastic = $this->client->index($params);

                if($resultElastic['result'] == 'created'){
                    DB::commit();

                    return redirect()->route('documento', ['id' => $documento->id])
                        ->with('success', 'Documento enviado com sucesso.');
                }else{
                    throw new Exception((string)$resultElastic);
                }

               
    
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

        //$elasticObject = $documento->toElasticObject();
        return view('admin.documento.show',compact('documento'));
    }

    public function destroy($id)
    {

        try{
            DB::beginTransaction();
            $documento = Documento::with('palavrasChaves')->find($id);

            $documento->palavrasChaves()->delete();
            $documento->delete();

            Storage::delete("uploads/$documento->arquivo");

            $params = [
                'index' => 'normativas',
                'type'  => '_doc',
                'id'    => $documento->arquivo,
            ];
            
            $response = $this->client->delete($params);

            DB::commit();

            return redirect()->route('documentos')
                ->with('success', 'Documento removido com sucesso.');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()
			    ->back()
			    ->with('error', $e->getMessage());
        }

    }

}
