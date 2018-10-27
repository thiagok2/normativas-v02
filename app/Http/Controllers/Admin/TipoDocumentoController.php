<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\TipoDocumento;


class TipoDocumentoController extends Controller
{
    public function index(){

        $tipodocumentos = TipoDocumento::all();

        return view('admin.tipodocumento.index', compact('tipodocumentos'));
    }
}
