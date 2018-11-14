<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Unidade;
use App\User;
use App\Http\Resources\Unidade as UnidadeResource;

class UnidadeRestController extends Controller
{
    public function index(){

        $unidades = Unidade::paginate(15);
        $result = UnidadeResource::collection($unidades);

        $message = "OK";

        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);

    }

    public function store(Request $request, Unidade $unidade){
        $data = $request->all();
        $unidade->fill($data);

        if(auth()->check()){
            $unidade->user()->associate(auth()->user()->id);
        }else{//TODO
            $user = User::find(1);
            $unidade->user()->associate($user);
        }

        if($request->filled('responsavel_id')){
            $responsavel = User::find($request->responsavel_id);
            $unidade->responsavel()->associate($responsavel);
        }
         
       
        $unidade->save();
        $message = "Unidade criada com sucesso.";
        $result = new UnidadeResource($unidade);

        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 201);

    }

    public function show($id){
        $unidade = Unidade::find($id);

        if(is_null($unidade)){
            $message = 'Unidade não encontrada';
            $response = [
                'success' => false,
                'data'    => [],
                'message' => $message
            ];

            return response()->json($response, 404);
        }else{
            $message = 'Unidade recuperada com sucesso';

            $result = new UnidadeResource($unidade);
            $response = [
                'success' => true,
                'data'    => $result,
                'message' => $message
            ];

            return response()->json($response, 200);

        }
    }

    public function update(Request $request, Unidade $unidade){

    }

    public function destroy($id){
        $unidade = Unidade::find($id);
        $unidade->delete();
        $message = 'Unidade removida com sucesso';

        $result = new UnidadeResource($unidade);
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message
        ];

        return response()->json($response, 200);
    }
    
}
