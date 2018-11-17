<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Documento;

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


    public function store(Request $request, User $user){
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
                ->with(['success'=> 'Cadastro concluído com sucesso.']);
        }
       
    }
}
