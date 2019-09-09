<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Documento;

use Illuminate\Support\Facades\Validator;
use App\Models\Convite;
use App\Models\Unidade;

class UsuarioController extends Controller
{

    public function index(Request $request){
        if($request->id){
            $user = User::find($request->id);
        }else{
            $user = auth()->user();
        }
       

        $usuarios = User::where('unidade_id', $user->unidade_id)->get();

        $documentos = Documento::with('tipoDocumento','user','palavrasChaves')->where('user_id',$user->id)->simplePaginate(20);

        return view('admin.usuario.index', compact('user','usuarios','documentos'));
    }

    public function newGestor(Request $request){
        $unidade = Unidade::find($request->unidade_id);
        $usuario = new User();
        $usuario->name = $unidade->contato;
        $usuario->email = (strpos($unidade->email, ';') !== false)  ? trim(explode(',', $unidade->email)[0]) : $unidade->email;
        $usuario->tipo = User::TIPO_GESTOR;
        $usuario->unidade()->associate($unidade);

        $message = "Confirme os dados do responsável";

        return view('admin.usuario.create', compact('unidade', 'usuario'));
    }

    public function edit($id){
        $user = User::find($id);

        $alerta = null;
        if (!$user->confirmado){
            $alerta = "Usuário ainda não atualizou seus dados.";
        }

        return view('admin.usuario.edit', compact('user','alerta'));
    }

    public function search(Request $request){
        $usuarios = User::with('unidade')->simplePaginate(20);

        $q = $request->q;

        if($q){
            $usuarios = User::with('unidade')
                ->orWhere('name','ilike', '%'.$q.'%')
                ->orWhere('email','ilike', '%'.$q.'%')
            ->simplePaginate(20);
        }else{
            $q = '';
            $usuarios = User::with('unidade')->simplePaginate(20);
        }
        
        return view('admin.usuario.search', compact('usuarios','q'));
    }


    public function store(Request $request, User $user){
        
        try{

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|confirmed',
                'password' => 'required|string|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $user = User::find($request->id);
            $primeiroAcesso = is_null($user->confirmado_em);
    
    
            $data = $request->all();
            $user->fill($data);
            $user->password =  Hash::make($data['password']);
    
            if(!$user->confirmado){
                $user->confirmado = true;
                $user->confirmado_em = date("Y-m-d H:i:s");
            }
    
            $user->save();
            DB::commit();
    
            if($primeiroAcesso){
                return redirect()->route('home')
                    ->with(['success'=> 'Cadastro concluído com sucesso. Agora você já pode enviar novos documentos do seu conselho.']);
            }else{
                return redirect()->route('home');
            }
        }catch(\Exception $e){
            DB::rollBack();

            $messageErro = (getenv('APP_DEBUG') === 'true') ? $e->getMessage():
            "Problemas na indexação do documento. Caso o problema persista, entre em contato com os administradores.";

            return redirect()
			    ->back()
			    ->with('error', $messageErro);
        }
        
       
    }

    public function convidar(Request $request){

        $unidadeId = auth()->user()->unidade_id;

        
        if(auth()->user()->isAdmin() && $request->has('unidade_id')){
            $unidadeId = $request->query('unidade_id');
        }

        $unidade = Unidade::find($unidadeId);
        $usuario = new User();


        return view('admin.usuario.create', compact('unidade','usuario'));
    } 

    public function create(Request $request, User $user){


        try{

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'tipo' => 'required|string|max:20',
                'email' => 'required|string|email|unique:users|max:255'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            DB::beginTransaction();

            

            $user = new User();
            $data = $request->all();
            $user->fill($data);


            $passwordRandom = '987654321';//bin2hex(openssl_random_pseudo_bytes(4));
            $user->email = trim($request->input('email'));
            $user->password = Hash::make($passwordRandom);

            if(auth()->user()->isGestor()){
                $user->unidade()->associate(auth()->user()->unidade);
            }else{
                $user->unidade_id = $request->unidadeId;
            }
            
            $convite = new Convite();

            $convite->enviarNovoUsuario($user, $passwordRandom);
            $user->save();

            if($request->has('unidadeId')){
                $unidade = Unidade::find($request->unidadeId);

                if (!$unidade->responsavel){
                    $unidade->responsavel()->associate( $user );
                    $unidade->save();
                }
            }


            DB::commit();


            return redirect()->route('home')
                        ->with(['success'=> "Convite enviado para $user->name($user->email)."]);

        }catch(\Exception $e){
            DB::rollBack();

            $messageError = getenv('APP_DEBUG') === 'true' ? $e->getMessage():
            "Operação não foi realizada. Verifique se os dados estão corretos. 
            Caso o problema persista, entre em contato com os administradores.";
        
            return redirect()->back()->withInput()->with('error', $messageError);
        }

    }

    public function reenviarConvite(Request $request, $id){

        try{
            DB::beginTransaction();

            $user = User::with('unidade')->find($id);


            $passwordRandom = bin2hex(openssl_random_pseudo_bytes(4));

            $user->password = Hash::make($passwordRandom);

            $convite = new Convite();

            $convite->enviarNovoUsuario($user, $passwordRandom);
            $user->save();

            DB::commit();
            
            return redirect()->route('usuarios')
                ->with(['success'=> "Novo convite enviado para $user->name($user->email)."]);

           
        }catch(\Exception $e){
            DB::rollBack();

            $messageError = getenv('APP_DEBUG') === 'true' ? $e->getMessage():
            "Operação não foi realizada. Verifique se os dados estão corretos. 
            Caso o problema persista, entre em contato com os administradores.";
        
            return redirect()->back()->withInput()->with('error', $messageError);
        }
        
    }

    public function destroy($id){

        try{
            DB::beginTransaction();
            $user = User::find($id);

            if($user && $user->documentos->isEmpty()){

                $user->delete();
                DB::commit();
                return redirect()->route('usuarios')
                            ->with(['success'=> "Usuário removido com sucesso"]);
            }else{
                return redirect()
                    ->back()
                    ->with('error', 'O usuário já enviou documentos. No momento, não pode ser excluído.');
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
