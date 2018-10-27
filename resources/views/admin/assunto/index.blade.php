@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
    <ol class="breadcrumb">
        <li><a href="../home">Painel</a></li>
        <li> <a href="#" class="active"><a href="#">Assuntos</a></li>
    </ol>
    <div class="page-header">
        <h1>Assuntos 
            <br/><small>Temas Amplos dos documentos</small>
        </h1>
    </div>

    <div class="container">
        <div class="row">
            @forelse ($assuntos as $assunto)
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="lead">{{$assunto->nome}}</span>

                            <div class="pull-right">
                                <a href="#">
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
    </div>

    
@stop