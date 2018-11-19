<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $fillable = [
        'nome','descricao'
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
