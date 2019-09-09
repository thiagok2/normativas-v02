<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

use App\Models\Estado;
use App\User;
use App\Models\Unidade;
use App\Models\Documento;
use App\Services\UnidadeQuery;

class UnidadeController extends Controller
{
    public function index(Request $request){

        $user = auth()->user();

        if($user->isAdmin()){
            $esfera = $request->query('esfera');
            $estado = $request->query('estado');
            $nome = $request->query('nome');

            $clausulas = [];
            if($esfera){
                $clausulas[] = ['esfera', '=', $esfera];  
            }

            if($nome){
                $clausulas[] = ['nome', 'ilike', '%'.strtoupper($nome).'%'];
            }

            if($estado){
                $clausulas[] = ['estado_id', $estado];
            }

            $unidades = Unidade::where($clausulas)->with('estado','responsavel')->withCount('documentos')->paginate(25);
            $documentos = Documento::paginate(25); 
            $estados = Estado::all();

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

        $estados = Estado::all();
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
        $unidade->user()->associate(auth()->user()->id);

        $unidade->save();
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
}
