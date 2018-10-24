<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PalavraChave extends Model
{

    protected $fillable = [
        'documento_id','tag'
    ];

    public function documento()
    {
        return $this->belongsTo('App\Documento');
    }
}
