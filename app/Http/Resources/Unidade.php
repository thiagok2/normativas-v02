<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;

class Unidade extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'tipo' => $this->tipo,
            'esfera' => $this->esfera,
            'sigla' => $this->sigla,
            'url' => $this->url,
            'contato' => $this->contato,
            'telefone' => $this->telefone,
            'responsavel' => new UserResource($this->responsavel)
        ];
    }
}
