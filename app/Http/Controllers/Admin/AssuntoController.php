<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Assunto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Documento;

class AssuntoController extends Controller
{
    public function index(){
        $assuntos = Assunto::all()->sortBy("created_at");;
        return view('admin.assunto.index',compact('assuntos'));
    }

    public function trashed(){
        $assuntos = Assunto::onlyTrashed()->get();
        return view('admin.assunto.trashed',compact('assuntos'));
    }

    public function create(Request $request){
        $assuntos = Assunto::all();

        return view('admin.assunto.create', compact('assuntos'));
    }

    public function edit(Request $request, $assuntoId){
        $assunto = Assunto::withTrashed()->find($assuntoId);
        $documentos = Documento::where('assunto_id',$assuntoId)->paginate(10);
        $assuntos = Assunto::all();
        return view('admin.assunto.edit', compact('assunto','assuntos','documentos'));
    }

    public function store(Request $request){

        try{
            DB::beginTransaction();
            
            $data = $request->all();


            
            if($request->has('id')){
                $assunto = Assunto::withTrashed()->find($request['id']);
            }else{
                $assunto = new Assunto();
                $validator = Validator::make($request->all(), $assunto->rules, $assunto->messages);
                if ($validator->fails())
                    return redirect()->back()->withInput()->withErrors($validator);
            
            }
                
            $assunto->fill($data);
           
            $assunto->save();
            DB::commit();
            return redirect()->route('Assuntos')
                        ->with('success', 'Assunto cadastrado com sucesso.');
        }catch(\Exception $e){

            DB::rollBack();
            
            return redirect()->back()->withInput()->with('error', 'Problemas no cadastro do assunto.\n'.$e->getMessage());;
        }
        
    }

    public function destroy($id){
        try{
            DB::beginTransaction();
            $assunto = Assunto::find($id);

            $documentos = Documento::where('assunto_id',$id)->get();
            if($documentos->isEmpty())
                $assunto->forceDelete();
            else
                $assunto->delete();
            DB::commit();

            return redirect()->route('Assuntos')
                            ->with(['success'=> "Assunto removido com sucesso"]);
        }catch(\Exception $e){
            DB::rollBack();

            return redirect()
			    ->back()
			    ->with('error', $e->getMessage());
        }
    }

    public function restore($id){
        $assunto = Assunto::withTrashed()->find($id);
        
        $assunto->restore();

        return redirect()->route('Assuntos')
                            ->with(['success'=> "Assunto restaurado. Agora está habilitado para uso novamente."]);
    }

}
