<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Unidade extends Model
{
    protected $fillable = [
        'nome', 'tipo', 'esfera','sigla','url','email','contato','telefone','endereco','contato2'
    ];

    public $timestamps = true;

    public $rules = [
        'nome' => 'required|string|max:255',
        'tipo' => 'required|string|max:20',
        'esfera' => 'required|string|max:20',
        'sigla' => 'required|string|max:10',
        'url' => 'nullable|url',
        'email' => 'required',
        'telefone' => 'required|string|max:100'
    ];

    public $messages = [
        'required' => 'O campo :attribute é obrigatório',
        'nome.max' => 'O campo :attribute deve ter no máximo 255 caracteres',
        'sigla.max' => 'O campo :attribute deve ter no máximo 10 caracteres',
        'telefone.max' => 'O campo :attribute deve ter no máximo 100 caracteres',
    ];

    public function responsavel(){
        return $this->belongsTo(User::class,'responsavel_id');
    }

    public function estado(){
        return $this->belongsTo(Estado::class,'estado_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function documentos(){
        return $this->hasMany(Documento::class);
    }
}
