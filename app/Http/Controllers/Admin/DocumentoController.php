<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TipoDocumento;
use App\Models\Assunto;
use App\Models\Documento;
use App\Models\PalavraChave;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\DocumentoResquest;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function index(){

        $documentos = Documento::with('tipoDocumento','user')->simplePaginate(20);

        return view('admin.documento.index', compact('documentos'));
    }

    public function create(){

        $unidade = auth()->user()->unidade;

        $tiposDocumento = TipoDocumento::all();
        $assuntos = Assunto::all();  

        return view('admin.documento.create', compact('unidade','tiposDocumento',  'assuntos'));
    }

    public function store(DocumentoResquest $request, Documento $documento){

        try{
            $data= $request->all();
         
            $documento = new Documento();
            $documento->fill($data);
    
            $documento->unidade()->associate(auth()->user()->unidade);
            $documento->user()->associate(auth()->user()->id);
    
            if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
    
                DB::beginTransaction();
    
                $tituloArquivo = str_replace(" ","",strtolower(preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($documento->numero)))));
                $tituloArquivo = $tituloArquivo."_".uniqid(date('HisYmd'));
    
                $extensao = $request->arquivo->extension();
                $arquivoNome = "{$tituloArquivo}.{$extensao}";
                $upload = $request->arquivo->storeAs('uploads', $arquivoNome);
                $documento->arquivo = $arquivoNome;
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
                DB::commit();

                return redirect()->route('documento', ['id' => $documento->id])
                    ->with('success', 'Documento enviado com sucesso.');
    
            }else{
                return redirect()
			    ->back()
			    ->with('error', "Insira um anexo de extensão PDF.");
            }


    
            

        }catch(\Exception $e){

            DB::rollBack();
            
            return redirect()
			    ->back()
			    ->with('error', $e->getMessage());
        }
    }

    public function show($id){
        $documento = Documento::with(['unidade','tipoDocumento','assunto','palavrasChaves'])->find($id);

        return view('admin.documento.show',compact('documento'));
    }

    public function destroy($id)
    {
        $documento = Documento::with('palavrasChaves')->find($id);

        $documento->palavrasChaves()->delete();
        $documento->delete();

        Storage::delete("uploads/$documento->arquivo");


        return redirect()->route('documentos')
            ->with('success', 'Documento removido com sucesso.');


    }

}
