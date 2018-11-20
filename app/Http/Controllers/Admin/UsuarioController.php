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

    public function edit($id){
        $user = User::find($id);

        return view('admin.usuario.edit', compact('user'));
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

            return redirect()
			    ->back()
			    ->with('error', $e->getMessage());
        }
        
       
    }

    public function convidar(Request $request){
        return view('admin.usuario.create');
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


            $passwordRandom = bin2hex(openssl_random_pseudo_bytes(4));
            $user->password = Hash::make($passwordRandom);
            $user->unidade()->associate(auth()->user()->unidade);

            $convite = new Convite();

            $convite->enviarNovoUsuario($user, $passwordRandom);
            $user->save();
            DB::commit();


            return redirect()->route('home')
                        ->with(['success'=> "Convite enviado para $user->name($user->email)."]);

        }catch(\Exception $e){
            DB::rollBack();

            return redirect()
			    ->back()
			    ->with('error', $e->getMessage());
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

            return redirect()->route('usuarios')
                ->with(['success'=> "Novo convite enviado para $user->name($user->email)."]);

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();

            return redirect()
			    ->back()
			    ->with('error', $e->getMessage());
        }
        
    }

    public function destroy($id){
        $user = User::find($id);

        if(!$user->confirmado){
            $user->delete();
        
            return redirect()->route('usuarios')
                        ->with(['success'=> "Usuário removido com sucesso"]);
        }else{
            return redirect()
                ->back()
                ->with('error', 'O usuário já confirmou seu cadastro. Não pode ser removido.');
        }



        
    }
}
