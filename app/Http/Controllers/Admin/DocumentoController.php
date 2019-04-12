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

    protected $queryParams = [];
    public function search(Request $request){
        $this->queryParams['unidadeQuery'] = $request['unidadeNome'];

        $this->queryParams['usuarioNome'] = $request['usuarioNome'];

        $this->queryParams['dataInicioEnvio'] = $request['dataInicioEnvio'];
        $this->queryParams['dataFimEnvio'] = $request['dataFimEnvio'];

        $this->queryParams['dataInicioPublicacao'] = $request['dataInicioPublicacao'];
        $this->queryParams['dataFimPublicacao'] = $request['dataFimPublicacao'];

        $list = Documento::query();
        
        if(isset($this->queryParams['unidadeQuery'])){
           $list->whereHas('unidade', function($query){
                $query->where('nome', 'ilike', '%'.$this->queryParams['unidadeQuery'].'%');
                $query->orWhere('sigla', 'ilike', '%'.$this->queryParams['unidadeQuery'].'%');
            });
        }
        if(isset($this->queryParams['usuarioNome'])){
            $list->whereHas('user', function($query){
                $query->where('name', 'ilike', '%'.$this->queryParams['usuarioNome'].'%');
                $query->orWhere('email', 'ilike', '%'.$this->queryParams['usuarioNome'].'%');
            });
        }

        if(isset($this->queryParams['dataInicioEnvio'])){
            $list->whereDate('data_envio','>=',$this->queryParams['dataInicioEnvio']);
        }

        if(isset($this->queryParams['dataFimEnvio'])){
            $list->where('data_envio','<=',$this->queryParams['dataFimEnvio']);
        }

        if(isset($this->queryParams['dataInicioPublicacao'])){
            $list->where('data_publicacao','>=',$this->queryParams['dataInicioPublicacao']);
        }

        if(isset($this->queryParams['dataFimPublicacao'])){
            $list->where('data_publicacao','<=',$this->queryParams['dataFimPublicacao']);
        }


        $unidadeUser = auth()->user()->unidade;
        if(!auth()->user()->isAdmin()){
            $list->where('unidade_id',$unidadeUser->id);
        }

        $documentos = $list->paginate(25);


        $queryParams = $this->queryParams;

        return view('admin.documento.index', compact('documentos','queryParams'));
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
            $messageErro = (getenv('APP_DEBUG') === 'true') ? $e->getMessage():
            "Problemas na indexação do documento. Caso o problema persista, entre em contato pelo email normativas@ness.com.br";

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

            $result = $this->client->get($params);

            if($result['found']){
                $response = $this->client->delete($params);
            }

            Storage::delete("uploads/$documento->arquivo");
            
            DB::commit();

            return redirect()->route('documentos')
                ->with('success', 'Documento removido com sucesso.');

        }catch(\Exception $e){
            DB::rollBack();

            $messageErro = (getenv('APP_DEBUG') === 'true') ? $e->getMessage():
            "Documento não foi excluído. Caso o problema persista, entre em contato pelo email normativas@ness.com.br";
            
            return redirect()
			    ->back()
			    ->with('error', $messageErro);
        }

    }

}
