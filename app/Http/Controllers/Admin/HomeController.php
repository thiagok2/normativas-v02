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
    public $unidadeId;
    public $estadoId;

    public function index(Request $request)
    {
        try{

            $unidade = Unidade::find(auth()->user()->unidade_id);
            $this->unidadeId = $unidade->id;
            $this->estadoId = $unidade->estado_id;

            $user = auth()->user();
            $user->ultimo_acesso_em = date("Y-m-d H:i:s");
            $user->save();            

            if(!$unidade->confirmado){

                Log::warning('[home::redirect::unidade-edit] :: !$unidade->confirmado');

                return redirect()->route('unidade-edit', ['id' => $unidade->id])
                        ->with('error', 'Confirme os dados da sua unidade.');
            }

            if(!auth()->user()->confirmado){
                Log::warning('[home::redirect::usuario-edit] :: !auth()->user()->confirmado');

                return redirect()->route('usuario-edit', ['id' => auth()->user()->id])
                    ->with('success', 'Confirme seus dados e cadastre uma nova senha.');
            }

            if($user->isAdmin()){

                $documentosCount = Documento::count();
                $usersCount = User::count();
                $documentosPendentesCount = Documento::where('completed', false)->count();
                $documentos = Documento::with('unidade','tipoDocumento','palavrasChaves')->orderBy('data_envio', 'desc')->paginate(10);
                $unidadesNaoConfirmadas = Unidade::where('confirmado',false)->paginate(10);            
                $unidades = Unidade::has('documentos')                            
                    ->withCount('documentos')               
                    ->orderBy('documentos_count', 'desc')
                    ->paginate(10);     

            }else if($user->isAcessor()){
                $query = Documento::query();
                $query->whereHas('unidade', function($query){
                    $query->where( 'estado_id',$this->estadoId);
                });
                $documentosCount = $query->count();

                $query = User::query();
                $query->whereHas('unidade', function($query){
                    $query->where( 'estado_id',$this->estadoId);
                });
                $usersCount = $query->count();

                $query = Documento::query();
                $query = $query->where('completed', false);
                $query->whereHas('unidade', function($query){
                    $query->where( 'estado_id',$this->estadoId);
                });
                $documentosPendentesCount = $query->count();

                $query = Documento::query();
                $query->whereHas('unidade', function($query){
                    $query->where( 'estado_id',$this->estadoId);
                });
                
                $documentos = $query->with('unidade','tipoDocumento','palavrasChaves')->orderBy('data_envio', 'desc')->paginate(10);
                
                
                $query = Unidade::query();
                $query->where('confirmado',false);
                $query->where( 'estado_id',$this->estadoId);
                $unidadesNaoConfirmadas = $query->paginate(10);


                $query = Unidade::query();
                $query->withCount('documentos');
                $query->where( 'estado_id',$this->estadoId);
                $query->orderBy('documentos_count', 'desc');
                $unidades = $query->paginate(10);

                
            }else if($user->isConselho()){
                $documentosCount = Documento::where('unidade_id',$unidade->id)->count();
                $usersCount = User::where('unidade_id', $unidade->id)->count();
                $documentosPendentesCount = Documento::where([
                    ['completed', false],
                    ['unidade_id', $unidade->id]
                ])->count();

                $documentos = Documento::with('unidade','tipoDocumento','palavrasChaves')
                    ->where('unidade_id',$unidade->id)
                    ->orderBy('data_envio', 'desc')->paginate(10);

                $documentosPendentesExtrator = Documento::with('unidade','tipoDocumento','palavrasChaves')
                    ->where('unidade_id',$unidade->id)
                    ->where('status_extrator', '<>', Documento::STATUS_EXTRATOR_INDEXADO)
                    ->where('tipo_entrada', Documento::ENTRADA_EXTRATOR)
                    ->orderBy('data_envio', 'desc')->paginate(10);
                

                Log::warning('[home::view::home2] :: $user->isConselho()');
                return view('home2',compact('documentos','documentosPendentesExtrator',
                    'documentosCount','documentosPendentesCount','usersCount'));
            }else{
                Log::warning('[home::redirect::usuarios]');
                return redirect()->route('usuarios');            
            }

            /** Indicadores Gestor */
            
            $countUnidadesConfirmadas = Cache::remember('countUnidadesConfirmadas', 7200, function () {
                return $this->unidadeQuery->countUnidadeConfirmadas();
            });

            $countUnidadesNaoConfirmadas = Cache::remember('countUnidadesNaoConfirmadas', 7200, function () {
                return $this->unidadeQuery->countUnidadeNaoConfirmadas();
            });

            $porcentagemConfirmadas = number_format(100*$countUnidadesConfirmadas/($countUnidadesConfirmadas + $countUnidadesNaoConfirmadas),2);
            $totalUnidades = $countUnidadesConfirmadas + $countUnidadesNaoConfirmadas;

            $countUnidadesConfirmadas30Dias = Cache::remember('countUnidadesConfirmadas30Dias', 7200, function () {
                return $this->unidadeQuery->countUnidadeConfirmadasUltimos30dias();
            });
            
            $evolucaoUnidadesConfirmadasMes = Cache::remember('evolucaoUnidadesConfirmadasMes', 7200, function () {
                return $this->unidadeQuery->evolucaoUnidadesConfirmadas6Meses();
            });

            $countEnviados30dias = Cache::remember('countEnviados30dias', 3600, function () {
                return $this->documentoQuery->countEnviados30dias();
            });
            
            $evolucaoEnviados6Meses = Cache::remember('evolucaoEnviados6Meses', 5400, function () {
                return $this->documentoQuery->evolucaoEnviados6Meses();
            });

            $documentosPorTipo = Cache::remember('documentosPorTipo', 5400, function () {
                return $this->documentoQuery->documentosPorTipos();
            });

            $totalConsultas = Cache::remember('totalConsultas', 5400, function () {
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

            $tags = Cache::remember('tags', 4800, function () {
                return DB::table('palavra_chaves')
                ->select(DB::raw('count(*) as tag_count, tag'))
                ->groupBy('tag')
                ->limit(100)
                ->get();
            });

            $tagCount = Cache::remember('tagCount', 4800, function () {
                return DB::table('palavra_chaves')->distinct('tag')->count('tag');
            });

            Log::warning('[home::redirect::home]');
            return view('home',compact('documentos',
                'acessosGestores30Dias',
                'topConsultas',
                'totalConsultas', 'totalConsultas3060','percentConsultas',
                            'documentosPorTipo',
                            'evolucaoEnviados6Meses','countEnviados30dias','evolucaoUnidadesConfirmadasMes',
                            'unidadesNaoConfirmadas','countUnidadesConfirmadas30Dias',
                            'countUnidadesConfirmadas','porcentagemConfirmadas',
                            'totalUnidades','documentosCount','documentosPendentesCount','usersCount','tagCount','tags','unidades'));
        
        }catch(\Exception $e){
            Log::warning('Home::index::Exception');
            $messageError = $e->getMessage()."::".$e->getLine();


            /*
            $messageError = getenv('APP_DEBUG') === 'true' ? $e->getMessage():
            "Problemas ao realizar o login. Entre em contato com os administradores da plataforma.";
            */
            Log::error('Home::exception::'.$messageError);
            $message = $messageError;
            return view('errors/500', compact('message'));
            
        }
    }

    
}
