<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoDocumento extends Model
{
    protected $fillable = [
        'nome','descricao','sigla'
    ];

    public $timestamps = true;
    use SoftDeletes;

    public $rules = [
        'nome' => 'required|string|unique:tipo_documentos|max:100',
        'descricao' => 'string|max:255',
        'sigla' => 'string|nullable|unique:tipo_documentos|min:3|max:10'
    ];

    public $messages = [
        'required' => 'O campo :attribute é obrigatório'
    ];

    public function documentos(){
        return $this->hasMany(Documento::class);
    }

    public static function patterns(){
        $tipos = TipoDocumento::all();

        $patterns = $tipos->map(function ($t){
            $pattern = '['.strtoupper($t->nome[0]).strtolower($t->nome[0]).']'.substr($t->nome,1);

            return $pattern;
        });

        return $patterns;
    }
}
