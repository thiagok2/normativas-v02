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
use Illuminate\Support\Facades\Log;

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


        if(auth()->user()->isAdmin()){
            $documentos = Documento::with('tipoDocumento','user','unidade')
            ->simplePaginate(10);
        }else{
            $documentos = Documento::with('tipoDocumento','user','unidade')
            ->where('unidade_id',$unidade->id)
            ->simplePaginate(10);
        }

        

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
                 return redirect()->back()->withInput()->withErrors($validator);
            }

            $data= $request->all();
         
            $documento = new Documento();
            $documento->fill($data);

            $documento->data_envio = new \DateTime();

            $documento->unidade()->associate(auth()->user()->unidade);
            $documento->user()->associate(auth()->user()->id);
    
            if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
    
                DB::beginTransaction();
                $documento->nome_original = $request->arquivo->getClientOriginalName();
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
			    ->back()->withInput()
			    ->with('error', "Insira um anexo de extensão PDF.");
            }

        }catch(\Exception $e){

            DB::rollBack();
            $messageErro = (getenv('APP_DEBUG') === 'true') ? $e->getMessage()." : ".$e->getTraceAsString():
            "Problemas na indexação do documento. Caso o problema persista, entre em contato pelo email normativas@ness.com.br";


            Log::error($e->getFile().' - Linha '.$e->getLine().' - search::'.$e->getMessage());

            
            return redirect()
			    ->back()->withInput()
			    ->with('error', $messageErro);
        }
    }

    public function show($id){
        $documento = Documento::with(['unidade','tipoDocumento','assunto','palavrasChaves'])->find($id);

        //$elasticObject = $documento->toElasticObject();
        return view('admin.documento.show',compact('documento'));
    }

    public function destroy($id)
    {
        $id = (int)$id;
        try{
            DB::beginTransaction();
            $documento = Documento::with('palavrasChaves')->find($id);

            $documento->palavrasChaves()->delete();
            $documento->delete();

            $params = [
                'index' => 'normativas',
                'type'  => '_doc',
                'client' => [ 
                    'ignore' => 404
                ],
                'id'    => $documento->arquivo,
            ];

            try{
                $result = $this->client->get($params);

                if($result['found']){
                    $response = $this->client->delete($params);
                }
            }catch(\Exception $e){
                //Tentou excluir um documento que não estava indexado
            }
           
            Storage::delete("uploads/$documento->arquivo");
            
            DB::commit();

            return redirect()->route('documentos')
                ->with('success', 'Documento removido com sucesso.');

        }catch(\Exception $e){
            DB::rollBack();

            $messageErro = (getenv('APP_DEBUG') === 'true') ? $e->getMessage():
            "Documento não foi excluído. Caso o problema persista, entre em contato pelo email normativas@ness.com.br";
            
            Log::error($e->getFile().' - Linha '.$e->getLine().' - search::'.$e->getMessage());

            
            return redirect()
			    ->back()
			    ->with('error', $messageErro);
        }

    }

    public function edit(Request $request, $documentoId){
        $documento = Documento::find($documentoId);

        $unidade = auth()->user()->unidade;

        $tiposDocumento = TipoDocumento::all();

        $assuntos = Assunto::all(); 
        
        $tags = ( $documento->palavrasChaves ) ? $documento->palavrasChaves->pluck('tag') : [];
        $tags = str_replace('"', '', $tags);
        $tags = str_replace('[', '', $tags);
        $tags = str_replace(']', '', $tags);
    
        return view('admin.documento.edit', compact('tags','documento','unidade','tiposDocumento',  'assuntos'));
    }

    public function update(Request $request, $documentoId){
        $documento = Documento::find($documentoId);

        $data= $request->all();
        $documento->fill($data);

        $tags = explode(",", $data["palavras_chave"]);
        if(is_array($tags) && count($tags)>0){
            $documento->palavrasChaves()->delete(); 
            foreach ($tags as $t) {
                $palavra = new PalavraChave();
                $palavra->tag = substr($t,0,100);

                $palavra->documento()->associate($documento);
                $documento->palavrasChaves()->save($palavra);
            }
        }

        $documento->completed = $documento->isCompleto();
        $documento->save();

        if($documento->completed){
            $bodyDocumentElastic = $documento->toElasticObject();

            if($request->hasFile('arquivo_novo') && $request->file('arquivo_novo')->isValid()){
                $urlArquivo = $documento->urlizer($documento->unidade->sigla."_".$documento->numero);
                $urlArquivo = $urlArquivo."_".uniqid().".pdf";
    
                $arquivoOld = $documento->arquivo;
    
                $documento->arquivo = $urlArquivo;
                $documento->nome_original = $request->arquivo_novo->getClientOriginalName();
                $request->arquivo_novo->storeAs('uploads', $urlArquivo);
                $documento->save();
    
                $arquivoData = file_get_contents($request["arquivo_novo"]);
    
                
                Storage::delete("uploads/$arquivoOld");
    
            }
            else{//atualizar dados novos
                if(Storage::exists('uploads/'.$documento->arquivo)){
                    $arquivoData = Storage::get('uploads/'.$documento->arquivo);
                }elseif($documento->completed){
                    $result = $this->client->get([
                        'index' => 'normativas',
                        'type' => '_doc',
                        'id' => $documento->arquivo
                    ]);
                        
                    $arquivoData =  $result['_source']['data'];
                }
            }
    
            $bodyDocumentElastic["data"] = base64_encode($arquivoData);
            $params = [
                'index' => 'normativas',
                'type'  => '_doc',
                'id'    => $documento->arquivo,
                'pipeline' => 'attachment', 
                'body'  => $bodyDocumentElastic
                
            ];
    
            $this->client->index($params);
        }
        
        return redirect()->route('documentos')->with('success', 'Documento atualizado com sucesso.');

    }

    

}
