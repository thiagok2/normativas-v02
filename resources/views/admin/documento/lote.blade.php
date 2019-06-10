@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')

@stop

@section('content')    
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">Painel</a></li>
            <li> <a href="#" ><a href="#">Documentos</a></li>
            <li> <a href="#" class="active"><a href="#">Publicar em Lote</a></li>
        </ol>

        @include('admin.includes.alerts')
        <form name="form" id="form" action="{{route('enviar-lote')}}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="form-group no-margin">
                        <h4>Envio de arquivos em Lote</h4>
                    </div>                
                </div><!-- end box-header -->
                
                <div class="box-body">                            
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" class="form-control "  name="ano" id="ano" placeholder="Ano* (Ex.: 2019)"/>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <select class="form-control " required id="tipo_documento_id" name="tipo_documento_id">
                                    <option value="0">Tipo de Documento*</option>
                                    @foreach ($tiposDocumento as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <select class="form-control " required id="assunto_id" name="assunto_id">
                                    <option value="0">Assunto</option>
                                    @foreach ($assuntos as $ass)
                                        <option value="{{$ass->id}}">{{$ass->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="palavras_chave">Palavras chave</label>
                                <small class=".text-muted">(Insira os termos mais relevantes abordados neste documento)</small>
                                <input type="text" data-role="tagsinput" id="palavras_chave" name="palavras_chave" class=""/>

                            </div>
                        </div>
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-danger hidden alert-dismissible" id="alertas">
                                <div id="alertas-msg"></div>
                            </div>
                            <p id="loading"></p>
                            <span class="btn btn-primary btn-bg fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>Anexar documentos...</span>
                                <!-- The file input field used as target for the file upload widget -->
                                <input type="file" id="fileupload" name="documentos[]" data-url="{{route('upload-lote')}}" multiple="" accept="application/pdf">
                            </span><br />
                            <small>(Selecione apenas documentos do tipo PDF)</small>
                            <p>
                            <div id="progress" class="progress hidden">
                                <div class="progress-bar progress-bar-success"></div>
                            </div>
                            <br/>
                            <div id="uploads" class="box hidden">
                                <div class="box-body">
                                    <table id="files_list" class="table table-striped table-hover table-responsive">

                                    </table>
                                </div>
                            </div>
                            <input type="hidden" name="file_ids" id="file_ids" value="">
                            <input type="hidden" name="ids" id="ids" value="">
                        </div>
                    </div><!-- end row -->
                </div><!-- end box-body -->    
            </div><!-- end box-->
            <input type="submit" class="btn btn-primary btn-lg" value="Avançar">
        </form>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('js/app-lote.js') }}"></script>
    <script src="{{ asset('js/jquery.ui.widget.js') }}"></script>

    <script src="{{ asset('js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('js/jquery.fileupload.js') }}"></script>
@endpush
