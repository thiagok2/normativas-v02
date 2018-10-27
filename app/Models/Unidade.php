<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Unidade extends Model
{
    protected $fillable = [
        'nome', 'tipo', 'esfera','sigla','url','email','contato','telefone'
    ];

    public function responsavel(){
        return $this->hasOne(User::class,'responsavel_id');
    }

    public function user(){
        return $this->hasOne(User::class,'user_id');
    }

    public function documentos(){
        return $this->hasMany(Documento::class);
    }
}
