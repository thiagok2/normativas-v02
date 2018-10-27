<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Documento extends Model
{

    protected $fillable = [
        'ano', 'titulo','numero','ementa','url','data_publicacao','tipo_documento_id',
        'assunto_id','unidade_id','arquivo'    ];

    public function palavrasChaves(){
        return $this->hasMany(PalavraChave::class);
    }

    public function assunto()
    {
        return $this->belongsTo(Assunto::class);
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}