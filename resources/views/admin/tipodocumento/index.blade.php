@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
    <ol class="breadcrumb">
        <li><a href="../home">Painel</a></li>
        <li> <a href="#" class="active"><a href="#">Tipos Documento</a></li>
    </ol>
    <div class="page-header">
        <h1>Documentos 
            <br/><small>Tipos de documentos a serem enviados</small>
        </h1>
    </div>

    <div class="container">
        <div class="row">
            @forelse ($tipodocumentos as $doc)
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="lead">{{$doc->nome}}</span>

                            <div class="pull-right">
                                <a href="#">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            {{$doc->descricao}}
                        </div>
                    </div>
                </div>
            @empty
                <li>Nenhum assunto</li>
            @endforelse
        </div>
    </div>
@stop