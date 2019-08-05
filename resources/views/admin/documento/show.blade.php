@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
   
@stop

@section('content')
    <div class="container-fluid">        
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

        @include('admin.includes.alerts')                  

        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="form-group no-margin">
                    <h4>Visualização de informações do arquivo</h4>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#general">Geral</a></li>
                    <li><a data-toggle="tab" href="#extra">Extra</a></li>
                </ul>                    
            </div><!-- end box-header -->
            
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">            
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
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="ano">Ano</label>
                                            <input type="text" class="form-control" id="ano" name="ano" 
                                            value="{{ $documento->ano }}" readonly/>
                                        </div>
                                    </div>
                
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="numero">Número</label>
                                            <input type="text" class="form-control" id="numero" name="numero"
                                            value="{{ $documento->numero }}" readonly/>
                                        </div>
                                    </div>
                
                                    <div class="col-sm-4">
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
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="tipo_documento">Tipo Documento</label>
                                            <input type='text' class="form-control" id="tipo_documento" name="tipo_documento"
                                            value="{{ $documento->tipoDocumento->nome }}" readonly/>
                                        </div>
                                    </div>
                
                                    <div class="col-sm-6">
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
                                                        <span class="label label-primary">{{$p->tag}}</span>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="criado">Criação</label>
                                                <input readonly value="{{$documento->created_at->format('d-m-Y')}}" class="form-control">
                                            </div>
                                        </div>
                                        @if ($documento->updated_at)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="update">Atualização</label>
                                                    <input readonly value="{{$documento->updated_at->format('d-m-Y')}}" class="form-control">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="numero_processo">Num. Processo</label>
                                                <input readonly value="{{$documento->numero_processo}}" class="form-control">
                                            </div>
                                        </div>
                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status_extrator">Status Extrator</label>
                                                <input readonly value="{{$documento->status_extrator}}" class="form-control">
                                            </div>
                                        </div>
                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="usuario">Usuário</label>
                                                <input readonly value="{{$documento->user->name}}" class="form-control">
                                            </div>
                                        </div>
                                    </div><!--end row -->
                                </div><!-- end div extra fields-->
                            </div><!--end tab-pane extra -->
                        </div><!--end tab-content -->                                                                                                                                                                                                
                    </div><!--end col -->
                </div><!--end row -->

                <div class="col-sm-6">
                    @if ($documento->isIndexado())
                        <a  target="_blank"  href="{{route('pdfNormativa',$documento->arquivo)}}">
                            <i class="fa fa-download fa-3x"></i>
                            <br/>
                            {{$documento->nomeOriginal()}}
                        </a>
                    @elseif ($documento->isBaixado()) 
                        <a href='{{ Storage::url("uploads/$documento->arquivo")}}' target="_blank">
                            <i class="fa fa-download fa-3x"></i>
                            <br/>
                            {{$documento->nomeOriginal()}}
                        </a>
                    @endif
                </div>
            </div><!-- end box-body -->  
        </div><!-- end box-->

        <div class="row">                                    
            <div class="col-sm-12">
                <form method="post" action="{{route('delete',['id' => $documento->id])}}">
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="btn btn-danger btn-lg pull-right" data-toggle="modal" data-target="#modalConfirm">Excluir</button>

                    <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Confirmação de exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Tem certeza que deseja excluir este documento?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->                                        
                </form>
            </div>                    
        </div><!--end row -->
    </div><!--end container -->
@stop