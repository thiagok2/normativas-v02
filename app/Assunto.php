<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    public function documentos(){
        return $this->hasMany('App\Documento');
    }
}
