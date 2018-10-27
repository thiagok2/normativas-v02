<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Assunto;

class AssuntoController extends Controller
{
    public function index(){

        $assuntos = Assunto::all();
        //dd($assuntos);

        return view('admin.assunto.index',compact('assuntos'));
    }
}
