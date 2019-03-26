<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\Unidade;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Models\PalavraChave;

use App\Services\UnidadeQuery;
use App\Services\DocumentoQuery;
use App\Services\SearchQuery;

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

        $unidadeQuery = new UnidadeQuery();

        $countUnidadesConfirmadas = $unidadeQuery->countUnidadeConfirmadas();
        $countUnidadesNaoConfirmadas = $unidadeQuery->countUnidadeNaoConfirmadas();
        $porcentagemConfirmadas = number_format(100*$countUnidadesConfirmadas/($countUnidadesConfirmadas + $countUnidadesNaoConfirmadas),2);
        $totalUnidades = $countUnidadesConfirmadas + $countUnidadesNaoConfirmadas;
        $countUnidadesConfirmadas30Dias = $unidadeQuery->countUnidadeConfirmadasUltimos30dias();
        
        $evolucaoUnidadesConfirmadasMes = $unidadeQuery->evolucaoUnidadesConfirmadas();

        $documentoQuery = new DocumentoQuery();
        $countEnviados30dias = $documentoQuery->countEnviados30dias();
        $evolucaoEnviados6Meses = $documentoQuery->evolucaoEnviados6Meses();

        $unidadesNaoConfirmadas = Unidade::where('confirmado',false)->paginate(10);

        $documentosPorAssunto = $documentoQuery->documentosPorAssuntos();
        $documentosPorTipo = $documentoQuery->documentosPorTipos();

        $searchQuery = new SearchQuery();
        $totalConsultas = $searchQuery->countQuery();
        $totalConsultas3060 = $searchQuery->countQuery3060Dias();

        $denominador = ($totalConsultas3060[1]->total != 0) ? $totalConsultas3060[1]->total : 1;
        $percentConsultas = 100 * (($totalConsultas3060[0]->total - $totalConsultas3060[1]->total) / $denominador);

        $topConsultas = $searchQuery->topConsultas(100);

        

        $tags = DB::table('palavra_chaves')
                     ->select(DB::raw('count(*) as tag_count, tag'))
                     ->groupBy('tag')
                     ->get();
        
        //dd($tags);

        $tagCount = DB::table('palavra_chaves')->distinct('tag')->count('tag');

        $unidades = Unidade::withCount('documentos')->has('documentos', '>', 0)->orderBy('documentos_count', 'desc')
            ->paginate(10); 

        return view('home',compact('documentos',
            'topConsultas',
            'totalConsultas', 'totalConsultas3060','percentConsultas',
                        'documentosPorTipo','documentosPorAssunto',
                        'evolucaoEnviados6Meses','countEnviados30dias','evolucaoUnidadesConfirmadasMes',
                        'unidadesNaoConfirmadas','countUnidadesConfirmadas30Dias',
                        'countUnidadesConfirmadas','porcentagemConfirmadas',
                        'totalUnidades','documentosCount','usersCount','tagCount','tags','unidades'));
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
