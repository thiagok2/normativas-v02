<?php

namespace App\Http\Controllers;

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
    public function index()
    {

        $unidade = Unidade::find(auth()->user()->unidade_id);

        //$unidade = auth()->user()->unidade()->get();
        //echo "xxxxxxxxxxxxxxxxx".$unidade;



        if($unidade){
            $documentos = Documento::with('unidade','tipoDocumento','palavrasChaves')
                                ->where('unidade_id',$unidade->id)
                                ->orderBy('data_envio', 'desc')->take(15)->get();
                                
            $documentosCount = Documento::where('unidade_id',$unidade->id)->count();
        }else{
            $documentos = Documento::with('unidade','tipoDocumento','palavrasChaves')
                                ->orderBy('data_envio', 'desc')->take(15)->get();
                                
            $documentosCount = Documento::count();
        }

        $usersCount = User::where('unidade_id', $unidade->id)->count();


        $tags = DB::table('palavra_chaves')
                     ->select(DB::raw('count(*) as tag_count, tag'))
                     ->groupBy('tag')
                     ->get();

        $tagCount = DB::table('palavra_chaves')->distinct('tag')->count('tag');

        $termosPesquisados = DB::table('palavra_chaves')
                     ->select(DB::raw('count(*) as tag_count, tag'))
                     ->groupBy('tag')->limit(50)
                     ->get();


        return view('home',compact('documentos','documentosCount','usersCount','tagCount','tags','termosPesquisados'));
    }
}
