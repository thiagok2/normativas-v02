<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TipoDocumento;
use App\User;
use App\Models\Assunto;
use Illuminate\Support\Facades\Storage;
use App\Models\Documento;
use App\Models\PalavraChave;
use App\Services\DocumentoService;
use Elasticsearch\ClientBuilder;

class LoteController extends Controller
{
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

    public function create(){
        $user = auth()->user();

        if($user->isAcessor()){
            return redirect()->route('home')
            ->with('error', 'Como acessor, você não pode gerenciar documentos.');            
        }else{
            $unidade = auth()->user()->unidade;

            $tiposDocumento = TipoDocumento::all();

            $assuntos = Assunto::all(); 

            return view('admin.documento.lote', compact('unidade','tiposDocumento','assuntos'));        
        }            
    }

    public function store(Request $request){
       
        $tiposDocumento = TipoDocumento::all();
        $assuntos = Assunto::all(); 

        $documentos = Documento::whereIn("id", explode(",", $request->ids))->where('completed',false)->paginate(25);
        $alerta = "Complete os dados dos arquivos enviados, assim terão uma maior possibilidade de retorno nas buscas (Ano, Tipo Documento e Assunto).";
      

        return view('admin.documento.lote-edit', compact('unidade','tiposDocumento', 'assuntos','documentos','alerta'));

    }

    public function upload(Request $request){
        $documentos = [];
        
        foreach ($request->documentos as $doc) {
    
            
            $documento = new Documento();
            $documento->nome_original = $doc->getClientOriginalName();
            $documento->completed = false;

            $arquivoNome = basename($doc->getClientOriginalName(), ".pdf");
            $tipoDocumento = TipoDocumento::find($request->tipo_documento_id);
           
            if($tipoDocumento && !strpos(strtolower($arquivoNome), strtolower($tipoDocumento->nome))){
                $documento->titulo = $tipoDocumento->nome." ".$arquivoNome;
            }
            if($request->ano && !strpos($documento->titulo, $request->ano)){
                $documento->titulo .= " - ".$request->ano;
            }

            $documento->data_envio = new \DateTime();
            $documento->unidade()->associate(auth()->user()->unidade);
            $documento->user()->associate(auth()->user()->id);    

            $urlArquivo = $documento->urlizer($documento->unidade->sigla."_".$arquivoNome."_".uniqid().".pdf");
            $documento->arquivo = $urlArquivo;
            $documento->ano = $request->ano;
            $documento->assunto_id = ($request->assunto_id) ? $request->assunto_id : null;
            $documento->tipo_documento_id = ($request->tipo_documento_id) ? $request->tipo_documento_id : null;

            $documento->save();

            if($request->palavras_chave){
                $tags = explode(",", $request->palavras_chave);
                if(is_array($tags) && count($tags)>0){
                    foreach ($tags as $t) {
                        $palavra = new PalavraChave();
                        $palavra->tag = substr($t,0,100);
    
                        $palavra->documento()->associate($documento);
                        $documento->palavrasChaves()->save($palavra);
                    }
                }
            }

            $filename = $doc->storeAs('uploads', $documento->arquivo);
            $doc_file = new \stdClass();
            $doc_file->name = $doc->getClientOriginalName();
            $doc_file->ano = $documento->ano;
            if($documento->assunto_id){
                $assunto = Assunto::find($documento->assunto_id);
                $doc_file->assunto_nome = $assunto->nome;
            }

            if($documento->tipo_documento_id){
                $tipo  = TipoDocumento::find($documento->tipo_documento_id);
                $doc_file->tipo_documento_nome = $tipo->nome;
            }
            $doc_file->assunto_id = $documento->assunto_id;
            $doc_file->tipo_documento_id = $documento->tipo_documento_id;
            $doc_file->size = round(Storage::size($filename) / 1024, 2);
            $doc_file->fileID = $documento->arquivo;
            $doc_file->id = $documento->id;
            $doc_file->tags = $request->palavras_chave;
            $files[] = $doc_file;
        }

       
        return response()->json(array('files' => $files), 200);
    }

    public function updateItemLote(Request $request, $documentoId){
        $documento = Documento::find($documentoId);

        //dd($documento);

        $data = $request->all();
    
        $documento->fill($data);
        $documento->tipo_entrada = Documento::ENTRADA_LOTE;
        $documento->completed = true;

        $bodyDocumentElastic = $documento->toElasticObject();
        $arquivoData = Storage::get('uploads/'.$documento->arquivo);
        $bodyDocumentElastic["data"] = base64_encode($arquivoData);

        //dd($bodyDocumentElastic);

        $params = [
            'index' => 'normativas',
            'type'  => '_doc',
            'id'    => $documento->arquivo,
            'pipeline' => 'attachment', 
            'body'  => $bodyDocumentElastic
            
        ];

        $resultElastic = $this->client->index($params);
        $documento->save();
        return response()->json($resultElastic, 200);
    }

    public function documentosPendentes(Request $request){
        $user = auth()->user();

        if($user->isAcessor()){
            return redirect()->route('home')
            ->with('error', 'Como acessor, você não pode gerenciar documentos.');            
        }else{
            $unidade = auth()->user()->unidade;

            $documentos = Documento::where([
                ['unidade_id', $unidade->id],
                ['completed', false],
                ['tipo_entrada', Documento::ENTRADA_LOTE]
            ])->paginate(25);

            $tiposDocumento = TipoDocumento::all();
            $assuntos = Assunto::all(); 

            $alerta = "Complete os dados dos arquivos enviados, assim terão uma maior possibilidade de retorno nas buscas (Ano, Tipo Documento e Assunto).";
        
            return view('admin.documento.lote-edit', compact('unidade','tiposDocumento', 'assuntos','documentos','alerta'));
        }                  
    }

    public function destroy($id){
        $documentoService = new DocumentoService();

        $documentoService->delete($id);

        return response()->json('',200);

    }

}
