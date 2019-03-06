@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}">Painel</a></li>
        <li> <a href="#" class="active">Tipos Documento</a></li>
    </ol>
    <div class="page-header">
        <h2> 
            <small>Tipos de documentos a serem enviados</small>
        </h2>
        <a href="{{route('tiposdocumento-create')}}" class="btn btn-primary btn-lg">Novo Tipo de Documento</a>
    </div>

    <div class="container">
        @include('admin.includes.alerts')
        <div class="row">
            @forelse ($tipodocumentos as $doc)
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="lead">{{$doc->nome}}</span>

                            <div class="pull-right">
                                <a href="{{route('tiposdocumento-edit', $doc->id)}}">
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
        <div class="row">
            <a href="{{route('tiposdocumento-removidos')}}" class="btn btn-danger btn-lg">Tipos de Documentos Removidos</a>
        </div>
    </div>
@stop