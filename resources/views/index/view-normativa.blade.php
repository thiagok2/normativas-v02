@extends('layouts.master')

@section('content')
<!-- header -->
<section id="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <hr class="split">
                <h1><img src="/img/normativos-logo.png" srcset="/img/normativos-logo@2x.png 2x" alt="Normativas" /></h1>
                <hr class="split">
            </div>
        </div>
    </div>
</section>
<!-- end header -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">

                <div class="card-header">
                    {{ $normativa['ato']['titulo'] }}
                </div>

                <div class="card-body">
                    <form>                            
                        <table class="table table-condensed">
                            <tr>
                                <th>
                                    <strong>Ementa</strong>                                                
                                </th>
                                <td>
                                    {{ $normativa['ato']['ementa'] }}
                                </td>                                        
                            </tr>
                            <tr>
                                <th>
                                    <strong>Tipo: </strong>
                                </th>
                                <td>
                                    {{ $normativa['ato']['tipo_doc'] }}
                                </td>                                        
                            </tr>
                            <tr>
                                <th>
                                    <strong>Publicação: </strong>
                                </th>
                                <td>
                                    {{ date('d/m/Y', strtotime($normativa['ato']['data_publicacao'])) }}
                                </td>                                        
                            </tr>
                            <tr>
                                <th>
                                    <strong>Conselho: </strong>
                                </th>
                                <td>
                                    {{ $normativa['ato']['fonte']['orgao'] }}
                                </td>                                        
                            </tr>     
                            <tr>
                                <th>
                                    <strong>Esfera: </strong>
                                </th>
                                <td>
                                    {{ $normativa['ato']['fonte']['esfera'] }}
                                </td>                                        
                            </tr>    
                            <tr>
                                <th>
                                    <strong>Palavras-Chave: </strong>
                                </th>
                                <td>
                                    @foreach ($normativa['ato']['tags'] as $tag)
                                        <span class="badge badge-primary tags">{{ $tag }}</span>
                                    @endforeach
                                </td>                                        
                            </tr>                           
                                    

                        </table>
                                {{-- <p>
                                    <strong>Ementa</strong><br />{{ $normativa['ato']['ementa'] }}
                                </p>
                                <hr/>
                                <strong>Tipo: </strong>
                                {{ $normativa['ato']['tipo_doc'] }}
                                <br />
                                <strong>Publicação: </strong>
                                {{ date('d/m/Y', strtotime($normativa['ato']['data_publicacao'])) }}
                                <br />
                                <strong>Conselho: </strong>
                                {{ $normativa['ato']['fonte']['orgao'] }}
                                <br />
                                <strong>Esfera: </strong>
                                {{ $normativa['ato']['fonte']['esfera'] }}
                                <br />
                                <strong>Palavras-Chave:</strong>
                                @foreach ($normativa['ato']['tags'] as $tag)
                                    <span class="badge badge-primary tags">{{ $tag }}</span>
                                @endforeach --}}
                        <hr class="split-sm">
            </div>

            <div class="col-sm-12">
                    @if ($normativa['ato']['tipo_doc'] != 'doc' && $normativa['ato']['tipo_doc'] != 'docx' && substr($id, -3) != "doc" && substr($id, -4) != "docx")
                        <iframe src="/normativa/pdf/{{ $id }}" width="100%" height="600px">
                        </iframe> 
                    @endif                                                
                                                
                    <a href="javascript:history.back();" class="btn btn-primary"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Voltar</a>

                    <a href="/" class="btn btn-primary">
                        <span class="glyphicon glyphicon-chevron-left"></span> Nova Busca
                    </a>

                    <a href="/normativa/pdf/{{ $id }}" class="btn btn-primary" target="_blank">
                        Baixar
                    </a>

                    @if (Route::has('login') && isset($normativa['ato']['id_persisted']))
                        @auth
                            <a href="{{ route("documento-edit", $normativa['ato']['id_persisted']) }}" title="Editar" class="btn btn-primary pull-right">
                                <i class="fa fa-edit" ></i>
                            </a>
                        @endauth
                    @endif
                        
                        
                    @auth
                        @if (auth()->user()->isAdmin() && !$persisted)                                 
                            <a href="{{route('delete-elastic',$arquivoId)}}" class="btn btn-danger btn-lg pull-right" >Excluir</a>                                                            
                        @endif
                    @endauth                                                                          
                        
                </form>
            </div>
            </div>
            <hr class="split-sm">
        </div>        
    </div>        
</div>

<hr class="split-sm">

<section style="display:none">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <h4>Documentos relacionados</h4>
            </div>
        </div>
        @foreach ($documentsLikes["docs"] as $doc)
            <div class="row">
                <div class="col-lg-10 offset-lg-1 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <a href="/normativa/view/{{ $doc['_id'] }}">
                                    <i class="fa fa-external-link"></i> {{ $doc["_source"]["ato"]["titulo"] }}
                                </a>
                                <br/>
                                <span class="badge badge-dark">{{ $doc["_source"]["ato"]["tipo_doc"] }}</span>

                            </div>
                            <p class="card-text text-muted">
                                <small>{{ $doc["_source"]["ato"]["ementa"] }}</small>
                            </p>
                            
                            @foreach ($doc["_source"]['ato']['tags'] as $tag)
                                <span class="badge badge-info">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach  
    </div>
</section> 

<hr class="split">
@endsection