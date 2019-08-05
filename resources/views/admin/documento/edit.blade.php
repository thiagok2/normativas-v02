@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')

@stop


@section('content')        
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">Painel</a></li>
            <li> <a href="{{route('documentos')}}" ><a href="#">Documentos</a></li>
            <li> <a href="#" class="active"><a href="#">Editar</a></li>
        </ol>        

        @include('admin.includes.alerts')
        
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="form-group no-margin">
                    <h4>Edição de informações do arquivo</h4>
                </div>

                @if (!$documento->completed)
                    <div class="alert alert-warning fade in">
                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                        O documento ainda não foi indexado para a busca. Complete as informações.
                    </div>
                @endif

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#general">Geral</a></li>
                    <li><a data-toggle="tab" href="#extra">Extra</a></li>
                </ul>                    
            </div><!-- end box-header -->
            
            <div class="box-body">
                <form name="form" id="form" action="{{route('documento-update', $documento->id)}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input type="hidden" name="documento_id" id="documento_id" value="{{$documento->id}}"/>
                    <input type="hidden" name="tags" id="tags" value="{{$tags}}"/>            
                    <input type="hidden" class="form-control" value="{{ $unidade->nome }} - {{ $unidade->sigla }}" id="unidade">
                            
                    <div class="tab-content">
                        <div id="general" class="tab-pane fade in active">                                
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="ano">Ano*</label>
                                        <input type="text" value="{{ $documento->ano }}" required class="form-control" id="ano" name="ano" placeholder="Ex.: 2019" maxlength="4">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="numero">Número*</label>
                                        <input type="text" value="{{ $documento->numero }}" required class="form-control" id="numero" name="numero"
                                        placeholder="Ex.: CEE/BR Nº 12.123" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="data_publicacao">Data Publicação*</label>
                                        <div class='input-group date'>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar">
                                                </span>
                                            </span>
                                            <input type='date' value="{{ $documento->data_publicacao }}" required class="form-control" id="data_publicacao" name="data_publicacao"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tipo_documento">Tipo Documento*</label>
                
                                        <select class="form-control" required id="tipo_documento_id" name="tipo_documento_id">
                                            <option>Selecione</option>
                                            @foreach ($tiposDocumento as $tipo)
                                                <option value="{{$tipo->id}}" {{ $documento->tipo_documento_id == $tipo->id ? "selected":""}}>{{$tipo->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div><!-- end row-->
                
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="assunto">Assunto*</label>
                                        <select class="form-control" required id="assunto_id" name="assunto_id">
                                            <option>Selecione</option>
                                            @foreach ($assuntos as $assunto)
                                                <option value="{{$assunto->id}}" {{ $documento->assunto_id == $assunto->id ? "selected":""}}>{{$assunto->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="titulo">Título*</label>
                                        <input type="text" value="{{ $documento->titulo }}" required class="form-control" id="titulo" name="titulo" placeholder="Ex.: Deliberação CEEBR Nº 12321...">
                                    </div>
                                </div>
                            </div><!-- end row-->
                
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ementa">Ementa*</label>
                                        <textarea id="ementa" required class="form-control" rows="5" name="ementa">{{$documento->ementa}}</textarea>
                                        <small class=".text-muted">Máximo de 255 caracteres</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12" style="padding:0;">
                                        <div class="form-group">
                                            <label for="palavras_chave">Palavras chave</label>
                                            <small class="text-muted">(Insira os termos mais relevantes abordados neste documento)</small>
                                            <input type="text"  value="{{$documento->palavras_chave}}" data-role="tagsinput" id="palavras_chave" name="palavras_chave"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding:0;">
                                        <div class="form-group">
                                            <label for="url">URL</label>
                                            <small class=".text-muted">(Endereço online - opcional)</small>
                                            <div class='input-group'>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-globe">
                                                    </span>
                                                </span>
                                                <input type='url' value="{{$documento->url}}" class="form-control" id="url" name="url" placeholder="HTTP://..." maxlength="200"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end row-->
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
                                </div><!-- end row-->
                        
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
                                </div><!-- end row-->
                        
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
                                </div><!-- end row-->
                            </div><!-- end div extra fields-->
                        </div><!--end tab-pane extra -->
                    </div><!--end tab-content -->                                      
                            
                    <div class="row">
                        <div class="col-md-2">
                            @if ($documento->completed && $documento->isIndexado())
                                <a target="_blank"  href="{{route('pdfNormativa',$documento->arquivo)}}">
                                    <i class="fa fa-download fa-5x"></i><br/>
                                    {{$documento->nome_original ? $documento->nome_original : $documento->arquivo}}
                                </a>
                            @elseif ($documento->isBaixado()) 
                                <a href='{{ Storage::url("uploads/$documento->arquivo")}}' target="_blank">
                                    <i class="fa fa-download fa-5x"></i><br/>
                                    {{$documento->nome_original}}
                                </a>
                            @endif                    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="arquivo">Alterar arquivo(PDF)*</label>
                                <small class=".text-muted">(Tamanho máximo 5MB)</small>
                                <input id="arquivo_novo" name="arquivo_novo" class="form-control" type="file" accept="application/pdf"/>
                                <small class=".text-muted">Arquivos mal escaneados não são indexados para busca.</small>
                            </div>
                        </div>                    
                    </div><!--end row -->                                
            </div><!-- end box-body -->  
        </div><!-- end box-->    
            <div class="col-md-12">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-lg" value="Enviar">Atualizar</button>
                    <a href="{{route('documentos')}}" class="btn btn-warning btn-lg">Fechar</a>                
                    <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#modalConfirm">Excluir</button>
                </div>                                 
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
                                <a href="{{route('delete-edit',['id' => $documento->id])}}" class="btn btn-danger">Excluir</a>                                                        
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal --> 
            </div>
        </form>
    </div><!-- end div container-->
@endsection

@push('scripts')
    <script src="{{ asset('js/app-edit.js') }}"></script>
@endpush