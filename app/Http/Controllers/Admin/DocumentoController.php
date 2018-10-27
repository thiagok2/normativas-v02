<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TipoDocumento;
use App\Models\Assunto;
use App\Models\Documento;
use App\Models\PalavraChave;

class DocumentoController extends Controller
{
    public function index(){
        return view('admin.documento.index');
    }

    public function create(){

        $unidade = auth()->user()->unidade;

        $tiposDocumento = TipoDocumento::all();
        $assuntos = Assunto::all();  

        return view('admin.documento.create', compact('unidade','tiposDocumento',  'assuntos'));
    }

    public function store(Request $request, Documento $documento){

        $data= $request->all();
        $documento = new Documento();
        $documento->fill($data);

        $documento->unidade()->associate(auth()->user()->unidade);
        $documento->user()->associate(auth()->user()->id);

        $documento->save();

        $tags = explode(",", $data["palavras_chave"]);
        if(is_array($tags) && count($tags)>0){
            foreach ($tags as $t) {
                $palavra = new PalavraChave();
                $palavra->tag = $t;

                $palavra->documento()->associate($documento);
                $documento->palavrasChaves()->save($palavra);
            }
        }

        return redirect()->route('documentos');
    }
}
