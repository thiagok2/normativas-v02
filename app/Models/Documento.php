<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Documento extends Model
{

    protected $fillable = [
        'ano', 'titulo','numero','ementa','url','data_publicacao','tipo_documento_id',
        'assunto_id','unidade_id','arquivo'    ];


    public function toElasticObject(){

        $tags = [];
        foreach($this->palavrasChaves as $tag){
            $tags[] = $tag->tag;
        }


        $arquivoData = file_get_contents(url("storage/uploads/".$this->arquivo));
        $base64 = base64_encode($arquivoData);

        $object = [
            "ato" => [
                "ano" => $this->ano,
                "titulo" => $this->titulo,
                "ementa" => $this->ementa,
                "url"   =>  $this->url,
                "data_publicacao"   =>  $this->data_publicacao,
                "tipo_doc" => $this->tipoDocumento->nome,
                "arquivo"   =>  $this->arquivo,
                "tags"  =>  $tags,
                "fonte"   =>  [
                    "orgao"  => $this->unidade->nome,
                    "sigla" => $this->unidade->sigla,
                    "uf" => '',
                    "uf_sigla" => '',
                    "esfera" => $this->unidade->esfera,
                    "url" => ''
                ]
                ],
                "data" => $base64
        ];


        return collect($object);
    }

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
