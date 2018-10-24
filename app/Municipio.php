<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model{

    protected $fillable = [
        'nome', 'codigo_ibge', 'estado_id'
    ];

    public function estado(){
        return $this->belongsTo('App\Estado');
    }

    public function convite(){
        return $this->hasOne('App\Convite');
    }
}
