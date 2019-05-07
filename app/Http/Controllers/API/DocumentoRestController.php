<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DocumentoQuery;


class DocumentoRestController extends Controller
{
    public function documentosPorAssunto(){
        $documentoQuery = new DocumentoQuery();
        return response()->json(
            $documentoQuery->documentosPorAssuntos()
        );
    }

    public function documentosPorTipo(){
        $documentoQuery = new DocumentoQuery();
        return response()->json(
            $documentoQuery->documentosPorTipos()
        );
    }

    public function evolucaoEnviados6Meses(){
        $documentoQuery = new DocumentoQuery();
        return response()->json(
            $documentoQuery->evolucaoEnviados6Meses()
        );
    }

    public function evolucaoEnviadosPeriodo(Request $request){
        $dataInicio = $request->has('data_inicio')? $request->data_inicio : null; 
        $dataFim = $request->has('data_fim')? $request->data_fim : null; 

        $documentoQuery = new DocumentoQuery();
        return response()->json(
            $documentoQuery->evolucaoEnviados($dataInicio, $dataFim)
        );
    }
    
}
