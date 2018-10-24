<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $fillable = [
        'nome', 'tipo', 'esfera','sigla','url','email','contato','telefone'
    ];

    public function responsavel(){
        return $this->hasOne('App\User','responsavel_id');
    }

    public function user(){
        return $this->hasOne('App\User','user_id');
    }

    public function documentos(){
        return $this->hasMany('App\Documento');
    }
}
