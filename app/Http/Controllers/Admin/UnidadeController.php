<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Estado;
use App\Models\Unidade;

class UnidadeController extends Controller
{
    public function index(){

        $estados = Estado::all();

        $unidades = Unidade::all();
        
        return view('admin.unidade.index', compact('estados','unidades'));
    }
}
