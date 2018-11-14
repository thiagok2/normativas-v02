<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Unidade;
use App\User;
use App\Http\Resources\User as UserResource;

class UserRestController extends Controller
{
    public function index(){
        $users = User::paginate(15);

        $result = UserResource::collection($users);

        $message = "OK(15)";

        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function store(Request $request, User $user){
        $data = $request->all();
        $user->fill($data);

        if($request->filled('unidade_id')){
            $unidade = Unidade::find($request->unidade_id);
            $user->unidade()->associate($unidade);
        }

        $user->save();
        $message = "Usuário criado com sucesso.";
        $result = new UserResource($user);

        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 201);

    }

    public function show($id){

        try{
            $user = User::findOrFail($id);
            $result = new UserResource($user);
            $message = 'Usuário recuperado com sucesso.';
            
            $response = [
                'success' => true,
                'data'    => $result,
                'message' => $message
            ];

            return response()->json($response, 200);
        }catch(Exception $e){
            $message = 'Usuário não encontrado.';
            $response = [
                'success' => false,
                'data'    => [],
                'message' => $message
            ];

            return response()->json($response, 404);
        }  
    }

    public function update(Request $request, User $user){

    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        $message = 'Usuário removido com sucesso';

        $result = new UserResource($user);
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message
        ];

        return response()->json($response, 200);
    }
}
