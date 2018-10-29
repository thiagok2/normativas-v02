<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Estado;
use App\Models\Unidade;

class UnidadeController extends Controller
{
    public function index(Request $request){

        $esfera = $request->query('esfera');
        $estado = $request->query('estado');
        $nome = $request->query('nome');

        $clausulas = [];
        if($esfera){
            $clausulas[] = ['esfera', '=', $esfera];  
        }
        // if($estado){
        //     $clausulas[] = ['estado_id', '=', $estado];
        // }

        if($nome){
            $clausulas[] = ['nome', 'like', '%'.$nome.'%'];
        }

        $unidades = Unidade::orWhere($clausulas)->get();; 
        $estados = Estado::all();

       
        
        return view('admin.unidade.index', compact('estados','unidades','esfera','estado','nome'));
    }
}
