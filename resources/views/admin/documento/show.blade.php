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
        <li><a href="../home">Painel</a></li>
        <li> <a href="/documentos" ><a href="#">Documentos</a></li>
        <li> <a href="#" class="active"><a href="#">Detalhes</a></li>
    </ol>
    <div class="container">
        @include('admin.includes.alerts')
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="ano">Orgão</label>
                            <input type="text" class="form-control" id="ano" name="ano" 
                                value="{{$documento->unidade->nome}}" readonly/>
                        </div>
                    </div>
                </div>

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
                                    <span class="glyphicon glyphicon-calendar">
                                    </span>
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
                            <label for="assunto">Abrangência</label>
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
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="url">URL</label>
                            <div class='input-group date'>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-globe">
                                    </span>
                                </span>
                                <a class="form-control" id="url" name="url" 
                                    href="{{$documento->url}}">
                                    {{$documento->url}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div><!--end row -->

                <div class="row">
                    <div class="col-sm-6">
                        <a class="btn btn-primary btn-lg" target="_blank" href="https://normativas-dev.herokuapp.com/normativa/pdf/{{$documento->numero}}">Download</a>
                    </div>

                    <div class="col-sm-6">
                        <form method="post" action="{{route('delete',['id' => $documento->id])}}">
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-danger btn-lg pull-right" >Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop