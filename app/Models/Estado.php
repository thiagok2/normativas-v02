<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{

    protected $fillable = [
        'nome', 'sigla'
    ];

    public function municipios(){
        return $this->hasMany(Municipio::class);
    }

    public function convite()
    {
        return $this->hasOne(Convite::class);
    }

    public function unidades() 
    {
       return $this->hasMany(Unidade::class);
    }
 
}
