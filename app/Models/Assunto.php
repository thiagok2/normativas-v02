<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assunto extends Model
{
    protected $fillable = [
        'nome', 'descricao'
    ];

    public $timestamps = true;
    use SoftDeletes;

    public function documentos(){
        return $this->hasMany(Documento::class);
    }

   

    public $rules = [
        'nome' => 'required|string|unique:assuntos|max:100',
        'descricao' => 'string|max:255'
    ];

    public $messages = [
        'required' => 'O campo :attribute é obrigatório'
    ];

    public function isDesconhecido(){
        return $this->id == 0;
    }
    
}
