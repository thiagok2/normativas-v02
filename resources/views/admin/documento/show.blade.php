@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
   
@stop

@section('content')

    <div class="row">
        <div class="col-sm-12 mb-2">
            <a href="{{route('publicar')}}" class="btn btn-primary btn-lg">Publicar Novo</a>

            <a href="{{route('documentos')}}" class="btn btn-primary btn-lg">Últimos Documentos</a>
        </div>
    </div>
    <br/>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}">Painel</a></li>
        <li> <a href="{{route('documentos')}}" ><a href="#">Documentos</a></li>
        <li> <a href="#" class="active"><a href="#">Detalhes</a></li>
    </ol>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#general">Geral</a></li>
        <li><a data-toggle="tab" href="#extra">Extra</a></li>
    </ul>

    <div class="container">
        @include('admin.includes.alerts')              
        <div class="row">
            <div class="col-sm-8">

                <div class="tab-content">
                    <div id="general" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="ano">Orgão</label>
                                    <input type="text" class="form-control" id="ano" name="ano" 
                                    value="{{$documento->unidade->nome}}" readonly/>
                                </div>
                            </div>
                        </div><!--end row -->

                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="ano">Ano</label>
                                    <input type="text" class="form-control" id="ano" name="ano" 
                                    value="{{ $documento->ano }}" readonly/>
                                </div>
                            </div>
        
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="numero">Número</label>
                                    <input type="text" class="form-control" id="numero" name="numero"
                                    value="{{ $documento->numero }}" readonly/>
                                </div>
                            </div>
        
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="data_publicacao">Data Publicação</label>
                                    <div class='input-group date'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='date' class="form-control" id="data_publicacao" name="data_publicacao"
                                        value="{{ $documento->data_publicacao }}" readonly/>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end row -->
            
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="tipo_documento">Tipo Documento</label>
                                    <input type='text' class="form-control" id="tipo_documento" name="tipo_documento"
                                    value="{{ $documento->tipoDocumento->nome }}" readonly/>
                                </div>
                            </div>
        
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="assunto">Assunto</label>
                                    <input type='text' class="form-control" id="tipo_documento" name="tipo_documento"
                                    value="{{ $documento->assunto->nome }}" readonly/>
                                </div>
                            </div>
                        </div><!--end row -->
            
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="titulo">Título</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo" 
                                    value="{{$documento->titulo}}" readonly>
                                </div>
                            </div>
                        </div><!--end row -->
        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="ementa">Ementa</label>
                                    <textarea id="ementa" required class="form-control" rows="5" name="ementa" readonly>{{$documento->ementa}}</textarea>
                                </div>
                            </div>
                        </div><!--end row -->
        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="palavras_chave">Palavras chave</label>
                                    <ul class="list-inline">
                                        @foreach ($documento->palavrasChaves as $p)
                                            <li>
                                            <span class="label label-default">{{$p->tag}}</span>
                                            </li>
                                        @endforeach
                                    </ul>         
                                </div>
                            </div>
                        </div><!--end row -->

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="url">URL</label>
                                    <div class='input-group'>
                                        <span class="input-group-addon" style="text-align: left">
                                        <span class="glyphicon glyphicon-globe">                                                
                                        </span>
                                            <a href="{{$documento->url}}" target="_blank">
                                                {{$documento->url}}
                                            </a>
                                        </span>                                    
                                    </div>
                                </div>
                            </div>
                        </div><!--end row -->                    
                    </div><!--end tab-pane general -->

                    <div id="extra" class="tab-pane fade">
                        <div class="extra_fields">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="criado">Criação</label>
                                        <input readonly value="{{$documento->created_at->format('d-m-Y')}}" class="form-control">
                                    </div>
                                </div>
                                @if ($documento->updated_at)
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="update">Atualização</label>
                                            <input readonly value="{{$documento->updated_at->format('d-m-Y')}}" class="form-control">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="nome_original">Arquivo Original</label>
                                        <input readonly value="{{$documento->nome_original}}" class="form-control">
                                    </div>
                                </div>
                            </div><!--end row -->
                    
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tipo_entrada">Tipo Entrada</label>
                                        <input readonly value="{{$documento->tipo_entrada}}" class="form-control">
                                    </div>
                                </div>
                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="formato">Formato</label>
                                        <input readonly value="{{$documento->formato}}" class="form-control">
                                    </div>
                                </div>
                
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="url_extrator">URL Extrator</label>
                                        <input readonly value="{{$documento->url_extrator}}" class="form-control">
                                    </div>
                                </div>
                            </div><!--end row -->
                    
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="numero_processo">Num. Processo</label>
                                        <input readonly value="{{$documento->numero_processo}}" class="form-control">
                                    </div>
                                </div>
                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="status_extrator">Status Extrator</label>
                                        <input readonly value="{{$documento->status_extrator}}" class="form-control">
                                    </div>
                                </div>
                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="usuario">Usuário</label>
                                        <input readonly value="{{$documento->user->name}}" class="form-control">
                                    </div>
                                </div>
                            </div><!--end row -->
                        </div><!-- end div extra fields-->
                    </div><!--end tab-pane extra -->
                </div><!--end tab-content -->                                                                                                                                        
               
                <div class="row">
                    <div class="col-sm-6">
                        @if ($documento->isIndexado())
                            <a  target="_blank"  href="{{route('pdfNormativa',$documento->arquivo)}}">
                                <i class="fa fa-download fa-3x"></i>
                                <br/>
                                {{$documento->nomeOriginal()}}
                            </a>
                        @else
                            <a href='{{ Storage::url("uploads/$documento->arquivo")}}' target="_blank">
                                <i class="fa fa-download fa-3x"></i>
                                <br/>
                                {{$documento->nomeOriginal()}}
                            </a>
                        @endif
                    </div>
                    
                    <div class="col-sm-6">
                        <form method="post" action="{{route('delete',['id' => $documento->id])}}">
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-danger btn-lg pull-right" >Excluir</button>
                        </form>
                    </div>                    
                </div><!--end row -->
            </div><!--end col -->
        </div><!--end row -->
    </div><!--end container -->
@stop