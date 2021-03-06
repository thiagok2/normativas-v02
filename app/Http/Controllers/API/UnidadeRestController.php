<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Unidade;
use App\User;
use App\Http\Resources\Unidade as UnidadeResource;
use App\Models\Estado;
use App\Models\Municipio;
use App\Services\UnidadeQuery;

class UnidadeRestController extends Controller
{

    public function get(){
        return response()->json(Unidade::paginate(15));
    }
    public function evolucaoUnidadesConfirmadas6Meses(){
        $unidadeQuery = new UnidadeQuery();
        $evolucaoUnidadesConfirmadasMes = $unidadeQuery->evolucaoUnidadesConfirmadas6Meses();
    
        return response()->json(
            $evolucaoUnidadesConfirmadasMes
        );
    }

    public function evolucaoUnidadesConfirmadasPeriodo(Request $request){
        $dataInicio = $request->has('data_inicio')? $request->data_inicio : null; 
        $dataFim = $request->has('data_fim')? $request->data_fim : null; 
        
        $unidadeQuery = new UnidadeQuery();
        $evolucaoUnidadesConfirmadasMes = $unidadeQuery->evolucaoUnidadesConfirmadasPeriodo($dataInicio, $dataFim);
    
        return response()->json(
            $evolucaoUnidadesConfirmadasMes
        );
    }

    public function municipios(Request $request, $sigla){
        $estado = Estado::where("sigla", strtoupper($sigla))->first();
        $municipios = Municipio::where(
            [
                ["estado_id", $estado->id],
                ["criado", false],
            ]
            )->orderBy('nome', 'asc')->get();

        return response()->json(
            $municipios
        );

    }

    public function municipiosTodos(Request $request, $sigla){
        $estado = Estado::where("sigla", strtoupper($sigla))->first();
        $municipios = Municipio::where( "estado_id", $estado->id )->orderBy('nome','asc')->get();

        return response()->json(
            $municipios
        );

    }

    public function unidade(Request $request, $id){
        
        $unidade = Unidade::find($id);
        $gestor = $unidade->responsavel;
        return response()->json(
            array(
                "unidade" => $unidade,
                "gestor" => $gestor
            )
        );
    }


    
}
