<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\Estado;
use App\User;
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
            $clausulas[] = ['LOWER(nome)', 'like', '%'.strtolower($nome).'%'];
        }

        $unidades = Unidade::orWhere($clausulas)->get();; 
        $estados = Estado::all();

       
        
        return view('admin.unidade.index', compact('estados','unidades','esfera','estado','nome'));
    }

    public function show($id){
        $unidade = Unidade::find($id);


    }

    public function edit($id){
        $unidade = Unidade::find($id);

        $users = User::where("unidade_id", $id)->get();

        return view('admin.unidade.edit', compact('unidade','users'));
    }


    public function store(Request $request, Unidade $unidade){

        DB::beginTransaction();

        $unidade = Unidade::find($request->id);
        $data = $request->all();

        $unidade->fill($data);
        $unidade->user()->associate(auth()->user());
        $unidade->responsavel()->associate(auth()->user());
        if(!$unidade->confirmado){
            $unidade->confirmado = true;
            $unidade->confirmado_em = date("Y-m-d H:i:s");

        }

        $unidade->save();


        DB::commit();

        return redirect()->route('unidade-edit', ['id' => $unidade->id])
            ->with('success', 'Unidade atualizada com sucesso.');

    }
}
