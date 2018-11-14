<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Documento extends Model
{

    protected $fillable = [
        'ano', 'titulo','numero','ementa','url','data_publicacao','tipo_documento_id',
        'assunto_id','unidade_id'   ];


    public function toElasticObject(){

        $tags = [];
        foreach($this->palavrasChaves as $tag){
            $tags[] = $tag->tag;
        }

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
            ]
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

    function urlizer($str) {

        $str = strtolower($str);
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);
        $str = preg_replace('/[^a-z0-9]/i', '-', $str);
        $str = preg_replace("/[^a-z0-9_\s-]/", "", $str);
        $str = preg_replace('/_+/', '-', $str);
        $str = preg_replace("/[\s-]+/", " ", $str);
        $str = str_replace('.','-',$str);
        $str = str_replace(' ','-',$str);
        $str = str_replace('/','_',$str);
        $str = trim($str,"-");
        return strtolower($str);
    }
}
