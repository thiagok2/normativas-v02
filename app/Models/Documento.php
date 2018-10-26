<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{

    protected $fillable = [
        'ano', 'titulo','numero','ementa','url','data_publicacao','tipo_documento_id',
        'assunto_id','unidade_id'
    ];

    public function palavrasChaves(){
        return $this->hasMany('App\PalavraChave');
    }

    public function assunto()
    {
        return $this->belongsTo('App\Assunto');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo('App\TipoDocumento');
    }

    public function unidade()
    {
        return $this->belongsTo('App\Unidade');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
