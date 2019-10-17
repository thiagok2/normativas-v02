<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Convite;
use App\User;
use Illuminate\Support\Facades\Hash;

class PrimeiroAcessoController extends Controller
{
    public function first(Request $request){
        return view('auth.first');
    }

    public function request(Request $request){

        $usuario = User::where("email", $request->email)->first();

        if (!$usuario)
            return redirect()->back()->withInput()->with('error', "Este email(".$request->email.") não foi encontrado. Caso esteja correto, solicite o acesso.");
        else if($usuario->confirmado)
            return redirect()->route('login')
                ->with(['error'=> "Usuário ".$usuario->name."(".$usuario->email.") já possui cadastro no sistema.\n Caso não lembre senha, solicite recupera-la."]);
        else{

            $passwordRandom = bin2hex(openssl_random_pseudo_bytes(4));
            $usuario->password = Hash::make($passwordRandom);
            $convite = new Convite();

            $convite->enviarNovoUsuario($usuario, $passwordRandom);
            $usuario->save();


            return redirect()->route('login')
                ->with(['success'=> "Bem vindo ".$usuario->name."(".$usuario->email."). Um email com uma senha provisória foi enviado. Atualize seus dados."]);
        }
        
        return view('auth.first');
    }
}
