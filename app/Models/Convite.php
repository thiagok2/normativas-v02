<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Convite extends Model
{

    protected $fillable = [
        'contato', 'telefone', 'email','destinatario','mensagem'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }


}
