<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DocumentoResquest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'numero'    =>  'required|unique:documentos',
            'titulo'    =>  'required|max:255',
            'ano'       =>  'required|integer|min:4',
            'data_publicacao'   => 'required|date',
            'tipo_documento_id' => 'required',
            'assunto_id' => 'required',
            'ementa'    => 'required',
            'arquivo' => 'required|mimes:pdf',
            'url'   => 'nullable|active_url'
            


        ];
    }

    public function messages() {
        return [
          'required' => 'O campo :attribute é requerido',
          'ano.min' => 'O campo :attribute deve ter no mínimo 4 caracteres',
          'titulo.max'  => 'O campo :attribute deve ter no máximo 255 caracteres',
          'numero.unique'   => 'O número deve ser único entre os orgão. Dica: Use junto com a sigla do seu orgão',
          'ano.integer' => 'O campo :attribute deve inteiro',
          'arquivo.mimes'   => 'O documento anexado tem que estar no formato PDF',
          'active_url' => 'A url deve ter um formato válido. Ex.: http://www.seuorgao.com/arquivos/resolucao123'
        ];
      }
}
