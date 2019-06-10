@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')    
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">Painel</a></li>
            <li><a href="{{route('tiposdocumento')}}">Tipos de documentos</a></li>
            <li> <a href="#" class="active">Removidos</a></li>
        </ol>
        <div class="page-header">
            <a href="{{route('tiposdocumento-create')}}" class="btn btn-primary btn-lg">Novo Tipo de Documento</a>
        </div>

        @include('admin.includes.alerts')
        <div class="row">
            @forelse ($tipodocumentos as $t)
                <div class="col-lg-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <span class="lead">
                                {{$t->nome}}
                                ({{$t->documentos_count}})
                            </span>

                            <div class="pull-right">
                                <a href="{{route('tiposdocumento-edit',$t->id)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            {{$t->descricao}}
                        </div>
                        <div class="panel-footer">
                            Tipo de documento desabilitado em {{date('d/m/Y H:i:s', strtotime($t->deleted_at))}}        
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-lg-12">        
                    <div class="alert alert-warning">
                        Nenhum tipo de documento utilizado anteriormente foi desabilitado.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@stop