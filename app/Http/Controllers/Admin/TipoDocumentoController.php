<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\TipoDocumento;
use Illuminate\Support\Facades\DB;
use App\Models\Documento;
use Illuminate\Support\Facades\Validator;


class TipoDocumentoController extends Controller
{
    public function index(){
        $tipodocumentos = TipoDocumento::withCount('documentos')->get()->sortByDesc("documentos_count");

        return view('admin.tipodocumento.index', compact('tipodocumentos'));
    }

    public function trashed(){
        $tipodocumentos = TipoDocumento::onlyTrashed()->withCount('documentos')->get()->sortByDesc("documentos_count");
        return view('admin.tipodocumento.trashed',compact('tipodocumentos'));
    }

    public function create(Request $request){
        $tipodocumentos = TipoDocumento::withCount('documentos')->get()->sortByDesc("documentos_count");

        return view('admin.tipodocumento.create', compact('tipodocumentos'));
    }

    public function edit(Request $request, $tipoId){
        
        $tipodocumento = TipoDocumento::withTrashed()->find($tipoId);

        
        $documentos = Documento::with('tipoDocumento')->where('tipo_documento_id',$tipoId)->paginate(10);
        
        $tipodocumentos = TipoDocumento::withCount('documentos')->get()->sortByDesc("documentos_count");

        return view('admin.tipodocumento.edit', compact('tipodocumento','tipodocumentos','documentos'));
    }

    public function store(Request $request){

        try{
            DB::beginTransaction();            
            $data = $request->all();

            if($request->has('id')){
                $tipodocumento = TipoDocumento::withTrashed()->find($request['id']);
            }else{
                $tipodocumento = new TipoDocumento();
                $validator = Validator::make($request->all(), $tipodocumento->rules, $tipodocumento->messages);
                if ($validator->fails())
                    return redirect()->back()->withInput()->withErrors($validator);
            
            }
                
            $tipodocumento->fill($data);
           
            $tipodocumento->save();
            DB::commit();
            return redirect()->route('tiposdocumento')
                        ->with('success', 'Tipo de documento cadastrado com sucesso.');
        }catch(\Exception $e){
            DB::rollBack();
            
            $messageError = getenv('APP_DEBUG') === 'true' ? $e->getMessage():
            "Operação não foi realizada. Verifique se os dados estão corretos. 
            Caso o problema persista, entre em contato com os administradores.";
        
            return redirect()->back()->withInput()->with('error', $messageError);
        }
        
    }

    public function destroy($id){
        try{
            DB::beginTransaction();
            $tipodocumento = TipoDocumento::find($id);

            $documentos = Documento::where('tipo_documento_id',$id)->get();
            if($documentos->isEmpty()){
                $mensagem = "Tipo de documento removido permanentemente. Não havia documentos associados a esse tipo.";
                $tipodocumento->forceDelete();
            }else{
                $mensagem = "Tipo de documento desabilitado. Havia documentos associados a esse tipo.\n
                Você pode reabilitar esse tipo através do sistema.";
                $tipodocumento->delete();
            }
                
            DB::commit();

            return redirect()->route('tiposdocumento')
                            ->with(['success'=> $mensagem]);
        }catch(\Exception $e){
            DB::rollBack();

            $messageError = getenv('APP_DEBUG') === 'true' ? $e->getMessage():
            "Operação não foi realizada. Verifique se os dados estão corretos. 
            Caso o problema persista, entre em contato com os administradores.";
        
            return redirect()->back()->withInput()->with('error', $messageError);
        }
    }

    public function restore($id){
        $tipodocumento = TipoDocumento::withTrashed()->find($id);
        
        $tipodocumento->restore();

        return redirect()->route('tiposdocumento')
                            ->with(['success'=> "Tipo de documento restaurado. Agora está habilitado para uso novamente."]);
    }


}
