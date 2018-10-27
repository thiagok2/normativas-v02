<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    public function documentos(){
        return $this->hasMany(Documento::class);
    }
}
