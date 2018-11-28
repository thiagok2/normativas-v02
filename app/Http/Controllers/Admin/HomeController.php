<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\Unidade;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Models\PalavraChave;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $unidade = Unidade::find(auth()->user()->unidade_id);

        
        if(!$unidade->confirmado){
            return redirect()->route('unidade-edit', ['id' => $unidade->id])
                    ->with('error', 'Confirme os dados da sua unidade.');
        }

        if(!auth()->user()->confirmado){
            return redirect()->route('usuario-edit', ['id' => auth()->user()->id])
                ->with('success', 'Confirme seus dados e cadastre uma nova senha.');
        }

        if(auth()->user()->isAdmin()){

            $documentos = Documento::with('unidade','tipoDocumento','palavrasChaves')
                ->orderBy('data_envio', 'desc')->take(10)->get();
            
            $documentosCount = Documento::count();  
            
            $usersCount = User::count();
            
        }else{
            $documentos = Documento::with('unidade','tipoDocumento','palavrasChaves')
                ->where('unidade_id',$unidade->id)
                ->orderBy('data_envio', 'desc')->take(10)->get();
            
            $documentosCount = Documento::where('unidade_id',$unidade->id)->count();

            $usersCount = User::where('unidade_id', $unidade->id)->count();
        }

       


        $tags = DB::table('palavra_chaves')
                     ->select(DB::raw('count(*) as tag_count, tag'))
                     ->groupBy('tag')
                     ->get();

        $tagCount = DB::table('palavra_chaves')->distinct('tag')->count('tag');



        return view('home',compact('documentos','documentosCount','usersCount','tagCount','tags'));
    }

    public function getenv(){
        $APP_DEBUG = getenv('APP_DEBUG');
        $APP_ENV = getenv('APP_ENV');
        $APP_URL = getenv('APP_URL');
        $ELASTIC_URL = getenv('ELASTIC_URL');
        $MAIL_USERNAME = getenv('MAIL_USERNAME');
        $MAIL_PASSWORD = getenv('MAIL_PASSWORD');
        $DATABASE_URL = getenv('DATABASE_URL');
        


        return view('admin.env', compact('APP_DEBUG','APP_ENV','APP_URL','ELASTIC_URL','MAIL_USERNAME','MAIL_PASSWORD','DATABASE_URL'));
    }
}