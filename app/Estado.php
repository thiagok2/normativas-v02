<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{

    protected $fillable = [
        'nome', 'sigla'
    ];

    public function municipios(){
        return $this->hasMany('App\Municipio');
    }

    public function convite()
    {
        return $this->hasOne('App\Convite');
    }
}
