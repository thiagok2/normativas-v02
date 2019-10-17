<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Estado;
use App\Models\Unidade;

class AcessoriaController extends Controller
{
    public function create(Request $request){
        $estados = Estado::all();
        $unidade = new Unidade();

        return view('admin.acessoria.create', compact('estados','unidade'));
    }

    public function store(Request $request, Unidade $unidade){

    }
    
}
