@extends('adminlte::page')

@section('title', 'Convites')

@section('content_header')
    
@stop

@section('content')
    <ol class="breadcrumb">
        <li><a href="../home">Painel</a></li>
        <li> <a href="#" class="active"><a href="#">Documentos</a></li>
    </ol>


    <div class="container">
        <div class="row">
            <p>
                <a href="{{route('publicar')}}" class="btn btn-primary btn-lg">Publicar Novo</a>
            </p>
        </div>
    </div>
@stop