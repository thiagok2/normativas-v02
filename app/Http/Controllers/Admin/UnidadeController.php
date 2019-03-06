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

            $unidades = Unidade::where($clausulas)->with('estado')
            ->withCount('documentos')->orderBy('documentos_count', 'desc')
            ->paginate(25); 
            $estados = Estado::all();

            return view('admin.unidade.index', compact('estados','unidades','esfera','estado','nome'));

        }else{
            $unidade = auth()->user()->unidade;
            $users = User::where("unidade_id", $unidade->id)->paginate(25);

            return view('admin.unidade.edit', compact('unidade','users'));
        } 
        
    }

    public function show($id){
        $unidade = Unidade::find($id);


    }

    public function edit($id){
        $unidade = Unidade::find($id);

        $users = User::where("unidade_id", $id)->get();

        $documentos = Documento::where('unidade_id', $id)->get();

        return view('admin.unidade.edit', compact('unidade','users', 'documentos'));
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
}
