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
use App\Services\UsuarioQuery;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

    protected $usuarioQuery;
    protected $searchQuery;
    protected $documentoQuery;
    protected $unidadeQuery;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->usuarioQuery = new UsuarioQuery();
        $this->searchQuery = new SearchQuery();
        $this->documentoQuery = new DocumentoQuery();
        $this->unidadeQuery = new UnidadeQuery();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $unidade = Unidade::find(auth()->user()->unidade_id);
    
        $user = auth()->user();
        $user->ultimo_acesso_em = date("Y-m-d H:i:s");
        $user->save();
        
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
                ->orderBy('data_envio', 'desc')->paginate(10);
            
            $documentosCount = Documento::count();  
            $documentosPendentesCount = Documento::where('completed', false)->count();
            
            $usersCount = User::count();

            /** Indicadores Gestor */
            
            $countUnidadesConfirmadas = Cache::remember('countUnidadesConfirmadas', 3600, function () {
                return $this->unidadeQuery->countUnidadeConfirmadas();
            });

            $countUnidadesNaoConfirmadas = Cache::remember('countUnidadesNaoConfirmadas', 3600, function () {
                return $this->unidadeQuery->countUnidadeNaoConfirmadas();
            });

            $porcentagemConfirmadas = number_format(100*$countUnidadesConfirmadas/($countUnidadesConfirmadas + $countUnidadesNaoConfirmadas),2);
            $totalUnidades = $countUnidadesConfirmadas + $countUnidadesNaoConfirmadas;

            $countUnidadesConfirmadas30Dias = Cache::remember('countUnidadesConfirmadas30Dias', 3600, function () {
                return $this->unidadeQuery->countUnidadeConfirmadasUltimos30dias();
            });
            
            $evolucaoUnidadesConfirmadasMes = Cache::remember('evolucaoUnidadesConfirmadasMes', 3600, function () {
                return $this->unidadeQuery->evolucaoUnidadesConfirmadas6Meses();
            });

            $countEnviados30dias = Cache::remember('countEnviados30dias', 3600, function () {
                return $this->documentoQuery->countEnviados30dias();
            });
            
            $evolucaoEnviados6Meses = Cache::remember('evolucaoEnviados6Meses', 3600, function () {
                return $this->documentoQuery->evolucaoEnviados6Meses();
            });
    
            $unidadesNaoConfirmadas = Unidade::where('confirmado',false)->paginate(10);
    
            $documentosPorAssunto = Cache::remember('documentosPorAssunto', 3600, function () {
                return $this->documentoQuery->documentosPorAssuntos();
            });

            $documentosPorTipo = Cache::remember('documentosPorTipo', 3600, function () {
                return $this->documentoQuery->documentosPorTipos();
            });

            $totalConsultas = Cache::remember('totalConsultas', 3600, function () {
                return $this->searchQuery->countQuery();
            });

            $totalConsultas3060 = Cache::remember('totalConsultas3060', 3600, function () {
                return $this->searchQuery->countQuery3060Dias();
            }); 
    
            $denominador = ($totalConsultas3060[1]->total != 0) ? $totalConsultas3060[1]->total : 1;
            $percentConsultas = 100 * (($totalConsultas3060[0]->total - $totalConsultas3060[1]->total) / $denominador);
    
            $topConsultas = Cache::remember('topConsultas', 3600, function () {
                return $this->searchQuery->topConsultas(100);
            });

            $acessosGestores30Dias = Cache::remember('acessosGestores30Dias', 3600, function () {
                return $this->usuarioQuery->countAcessos30Dias();
            });
    
            $tags = Cache::remember('tags', 3600, function () {
                return DB::table('palavra_chaves')
                ->select(DB::raw('count(*) as tag_count, tag'))
                ->groupBy('tag')
                ->limit(100)
                ->get();
            });

            $tagCount = Cache::remember('tagCount', 3600, function () {
                return DB::table('palavra_chaves')->distinct('tag')->count('tag');
            });


            $unidades = Unidade::withCount('documentos')->has('documentos', '>', 0)->orderBy('documentos_count', 'desc')
                ->paginate(10); 
    
            return view('home',compact('documentos',
                'acessosGestores30Dias',
                'topConsultas',
                'totalConsultas', 'totalConsultas3060','percentConsultas',
                            'documentosPorTipo','documentosPorAssunto',
                            'evolucaoEnviados6Meses','countEnviados30dias','evolucaoUnidadesConfirmadasMes',
                            'unidadesNaoConfirmadas','countUnidadesConfirmadas30Dias',
                            'countUnidadesConfirmadas','porcentagemConfirmadas',
                            'totalUnidades','documentosCount','documentosPendentesCount','usersCount','tagCount','tags','unidades'));
                
        }else{
            $documentos = Documento::with('unidade','tipoDocumento','palavrasChaves')
                ->where('unidade_id',$unidade->id)
                ->orderBy('data_envio', 'desc')->paginate(10);
            
            $documentosCount = Documento::where('unidade_id',$unidade->id)->count();
            $documentosPendentesCount = Documento::where([
                ['completed', false],
                ['unidade_id', $unidade->id]
            ])->count();

            $usersCount = User::where('unidade_id', $unidade->id)->count();

            return view('home2',compact('documentos',
                        'documentosCount','documentosPendentesCount','usersCount'));
        }

    }

    
}
