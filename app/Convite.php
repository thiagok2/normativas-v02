<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convite extends Model
{

    protected $fillable = [
        'contato', 'telefone', 'email','destinatario','mensagem'
    ];

    public function estado()
    {
        return $this->belongsTo('App\Estado');
    }

    public function municipio()
    {
        return $this->belongsTo('App\Municipio');
    }

    public function user(){
        return $this->hasOne('App\User');
    }


}
