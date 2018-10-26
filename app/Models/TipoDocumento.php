<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $fillable = [
        'nome','descricao'
    ];

    public function documentos(){
        return $this->hasMany('App\Documento');
    }
}
