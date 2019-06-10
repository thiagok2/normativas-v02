@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')    
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">Painel</a></li>
            <li><a href="{{route('Assuntos')}}" class="active">Assuntos</a></li>
        </ol>
        <div class="page-header">
            <small>Assuntos gerais abordados nos documentos</small>
            <a href="{{route('assuntos-create')}}" class="btn btn-primary btn-lg">Novo Assunto</a>
        </div>

        @include('admin.includes.alerts')
        <div class="row">
            @forelse ($assuntos as $assunto)
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="lead">
                                {{$assunto->nome}}
                                ({{$assunto->documentos_count}})
                            </span>

                            <div class="pull-right">
                                <a href="{{route('assunto-edit',$assunto->id)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            {{$assunto->descricao}}
                        </div>
                    </div>
                </div>
            @empty
                <li>Nenhum assunto</li>
            @endforelse
        </div>
        <div class="row">
            <div class="col-lg-12">
                <a href="{{route('assunto-removidos')}}" class="btn btn-danger btn-lg">Assuntos Removidos</a>
            </div>            
        </div>
    </div>

    
@stop