<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Convite;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

use App\Models\Estado;
use App\User;
use App\Models\Unidade;
use App\Models\Documento;
use App\Models\Municipio;
use App\Services\UnidadeQuery;
use Illuminate\Support\Facades\Hash;

class UnidadeController extends Controller
{
    public function index(Request $request){

        $user = auth()->user();

        if($user->isAdmin()){
            $esfera = $request->query('esfera');
            $estado = $request->query('estado');
            $nome = $request->query('nome');

            $clausulas = [];
            $clausulas[] = ['tipo',Unidade::TIPO_CONSELHO];
            if($esfera){
                $clausulas[] = ['esfera', '=', $esfera];  
            }

            if($nome){
                $clausulas[] = ['nome', 'ilike', '%'.strtoupper($nome).'%'];
            }

            if($estado){
                $clausulas[] = ['estado_id', $estado];
            }

            $unidades = Unidade::where($clausulas)->with('estado','municipio' ,'responsavel')->withCount('documentos')->paginate(25);
            $documentos = Documento::paginate(25); 
            $estados = Estado::orderBy('nome', 'asc')->get();

            return view('admin.unidade.index', compact('estados','unidades','esfera','estado','nome','documentos'));

        }
        else if($user->isAcessor()){            
            if ($user->unidade->esfera == Unidade::ESFERA_FEDERAL){
                $estado = $request->query('estado');
                $estados = Estado::all();                            
            }            
            else{
                $estado = $user->unidade->estado_id;
                $estados = Estado::find([$estado]);
            }            

            $nome = $request->query('nome');

            $clausulas = [];
            $clausulas[] = ['tipo',Unidade::TIPO_CONSELHO];            
            $esfera = "Municipal";
            $clausulas[] = ['esfera', '=', $esfera];

            if($nome){
                $clausulas[] = ['nome', 'ilike', '%'.strtoupper($nome).'%'];
            }

            if($estado){
                $clausulas[] = ['estado_id', $estado];
            }            

            $unidades = Unidade::where($clausulas)->with('estado','municipio' ,'responsavel')->withCount('documentos')->paginate(25);
            $documentos = Documento::paginate(25);             

            return view('admin.unidade.index', compact('estados','unidades','esfera','estado','nome','documentos'));
        }else{
            $unidade = auth()->user()->unidade;
            $users = User::where("unidade_id", $unidade->id)->paginate(25);
            $documentos = Documento::where('unidade_id',$unidade->id)->paginate(25);
            return view('admin.unidade.edit', compact('unidade','users','documentos'));
        } 

    }

    public function show($id){

        $unidadQuery = new UnidadeQuery();
        $statusExtrator = $unidadQuery->documentosEtlPorStatus($id);

        $unidade = Unidade::find($id);

        $documentosCount = Documento::where('unidade_id',$unidade->id)->count();
        $documentosPendentesCount = Documento::where([
            ['completed', false],
            ['unidade_id', $unidade->id]
        ])->count();

        $documentos = $documentosPendentesCount = Documento::where([
            ['unidade_id', $unidade->id]
        ])->count();

        $users = User::where("unidade_id", $id)->get();

        $alerta = null;
        if (!$unidade->confirmado){
            $alerta = "Dados do conselho ainda não foram confirmados pelo seu gestor.";
        }

        return view('admin.unidade.show', compact('unidade', 'statusExtrator','documentos','documentosCount','documentosPendentesCount','users','alerta'));

    }

    public function create(Request $request){
        if(auth()->user()->isAdmin()){
            $estados = Estado::all();
        }
        else{
            $estado = auth()->user()->unidade->estado_id;
            $estados = Estado::find([$estado]);
        }
        $unidade = new Unidade();

        return view('admin.unidade.create', compact('estados','unidade'));
    }



    public function edit($id){
        $unidade = Unidade::find($id);

        $alerta = null;
        if (!$unidade->confirmado){
            $alerta = "Dados do conselho ainda não foram confirmados pelo seu gestor.";
        }

        $users = User::where("unidade_id", $id)->get();

        $documentos = Documento::where('unidade_id', $id)
            ->orderBy('ano', 'desc')
            ->paginate(10);

        return view('admin.unidade.edit', compact('unidade','users', 'documentos','alerta'));
    }

    public function save(Request $request, Unidade $unidade){

        $validator = Validator::make($request->all(), $unidade->rules, $unidade->messages);
             
        if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();


        $data = $request->all();                
        $unidade->fill($data);
        $unidade->estado_id = Estado::where("sigla", $unidade->estado_id)->first()->id;        
        $unidade->user()->associate(auth()->user()->id);
        $unidade->save();

        $municipio = Municipio::find($request->municipio_id);
        $municipio->criado = true;
        $municipio->save();

        DB::commit();

        return redirect()->route('usuario-new-gestor', ['unidade_id' => $unidade->id])
            ->with('success', 'Unidade cadastrada com sucesso. Agora confirme os dados para criar a conta ao gestor do conselho na plataforma Normativas.');

       
    }

    public function store(Request $request, Unidade $unidade)
    {
        try{

            $validator = Validator::make($request->all(), $unidade->rules, $unidade->messages);
            
           
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $primeiroAcesso = is_null($unidade->confirmado_em);
    
            $unidade = Unidade::find($request->id);
            $data = $request->all();
    
            $unidade->fill($data);
            
            
            $unidade->responsavel()->associate(auth()->user());
            
            if(!$unidade->confirmado){
                $unidade->confirmado = true;
                $unidade->confirmado_em = date("Y-m-d H:i:s");
    
            }
    
            $unidade->save();
            DB::commit();
           
    
            if(auth()->user()->confirmado){
                return redirect()->route('unidade-edit', ['id' => $unidade->id])
                    ->with('success', 'Unidade atualizada com sucesso.');
    
            }else{
                return redirect()->route('usuario-edit', ['id' => auth()->user()->id])
                    ->with('success', 'Confirme seus dados e altere a senha.');
            }

        }catch(\Exception $e){

            DB::rollBack();
            $messageError = getenv('APP_DEBUG') === 'true' ? $e->getMessage():
            "Operação não foi realizada. Verifique se os dados estão corretos. 
            Caso o problema persista, entre em contato com os administradores.";
            
           
            return redirect()->back()->withInput()->with('error', $messageError);
        }
       

    }

    protected $q;
    public function search(Request $request){
        $q = $request->q;
        $federal = Unidade::where('esfera','Federal')->first();

        $query = Unidade::with('estado')->withCount('documentos')->whereIn('esfera',['Estadual','Municipal']);
        if($request->has('q')){
            $this->q = $q;
            $query->whereHas('estado', function($query){
                $query->where('nome', 'ilike', '%'.$this->q.'%');
                $query->orWhere('sigla', 'ilike', '%'.$this->q.'%');
            });
        }
        


        $unidades = $query->orderBy('documentos_count', 'desc')->paginate(10);
        return view('unidades.index', compact('unidades','federal','q'));
    }

    public function page(Request $request, $unidadeUrl){
        $unidade = Unidade::with('estado')->withCount('documentos')->where('friendly_url',$unidadeUrl)->first();

        $tiposTotal = DB::select('select t.id, t.nome as tipo, count(*) as total from documentos d
        inner join tipo_documentos t on t.id = d.tipo_documento_id
        where d.unidade_id = ?
        group by t.id, t.nome', [$unidade->id]);

        

        foreach($tiposTotal as $tipo){
            $documentos["".$tipo->id.""] = Documento::where([['unidade_id',$unidade->id],['tipo_documento_id',$tipo->id]])->orderBy('ano','desc')->paginate(25);
        }
        
        return view('unidades.page', compact('unidade','tiposTotal','documentos'));
    }

    public function novoAcesso(Request $request){

        //dd($request);
        $unidade = Unidade::find($request->unidade_id);

        if(User::where("email",$request->gestor_email)->first()){
            return redirect()->back()->withInput()->with('error', "Já existe um usuário com o email: ".$request->gestor_email.". Um novo usuário/email é necessário.");
        }

        $unidade->nome = $request->conselho_nome;
        $unidade->sigla = $request->conselho_sigla;
        $unidade->convidado_em = date("Y-m-d H:i:s");
        $unidade->save();

        $gestor = $unidade->responsavel;
        $gestor->name = $request->gestor_nome;
        $gestor->email = $request->gestor_email;

        $gestor->save();

        $passwordRandom = bin2hex(openssl_random_pseudo_bytes(4));
        $gestor->password = Hash::make($passwordRandom);
        $convite = new Convite();
        $convite->enviarNovoUsuario($gestor, $passwordRandom);
        $gestor->save();

        return redirect()->route('unidades')
                ->with(['success'=> "Novo convite enviado para $gestor->name($gestor->email)."]);

    }
}
