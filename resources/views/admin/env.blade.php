@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
    <ol class="breadcrumb">
    <li><a href="{{route('home')}}">Painel</a></li>
        <li> <a href="#" class="active"><a href="#">Ambiente</a></li>
    </ol>
    <div class="page-header">
        <h1>Variáveis de ambiente 
            <br/><small>(.env)</small>
        </h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <a class="btn btn-lg btn-info" href="{{route('etl-comandos')}}">ETL</a><br/><br/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Últimos documentos enviados</h3>
                    </div>
                        <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped table-hover">
                            <tbody>
                                <tr>
                                    <td>APP_DEBUG</td>
                                    <td>{{$APP_DEBUG}}</td>
                                </tr>
                                <tr>
                                    <td>APP_ENV</td>
                                    <td>{{$APP_ENV}}</td>
                                </tr>
                                <tr>
                                    <td>APP_URL</td>
                                    <td>{{$APP_URL}}</td>
                                </tr>
                                <tr>
                                    <td>ELASTIC_URL</td>
                                    <td>{{$ELASTIC_URL}}</td>
                                </tr>
                                <tr>
                                    <td>MAIL_USERNAME</td>
                                    <td>{{$MAIL_USERNAME}}</td>
                                </tr>
                                <tr>
                                    <td>MAIL_PASSWORD</td>
                                    <td>{{$MAIL_PASSWORD}}</td>
                                </tr>
                                <tr>
                                    <td>DATABASE_URL</td>
                                    <td>{{$DATABASE_URL}}</td>
                                </tr>
                                <tr>
                                    <td>ETL_DIR</td>
                                    <td>{{$ETL_DIR}}</td>
                                </tr>
                                <tr @if(strpos($LOG_STATUS, 'FALHA') !== false) class="alert alert-danger" role="alert" @endif>
                                    <td>Log Status: ?{{strpos($LOG_STATUS, 'FALHA')}}?</td>
                                    <td>
                                        {{$LOG_STATUS}}
                                    </td>
                                </tr>
                                <tr @if(strpos($ELASTIC_STATUS, 'FALHA') !== false) class="alert alert-danger" role="alert" @endif>
                                    <td>Elastic Status</td>
                                    <td>
                                       {{$ELASTIC_STATUS}}
                                    </td>
                                </tr>
                                <tr @if(strpos($STORAGE_PATH_PERMISSION, '755') === false) class="alert alert-warning" role="alert" @endif>
                                    <td>STORAGE_PATH</td>
                                    <td>
                                        {{$STORAGE_PATH}}
                                        &emsp;&emsp;&emsp;
                                        @if ($STORAGE_PATH_EXISTS)
                                            Diretório existe
                                        @else
                                            Não encontrado
                                        @endif
                                        &emsp;&emsp;&emsp;
                                        Permissões:&emsp;
                                        {{$STORAGE_PATH_PERMISSION}}
                                    </td>
                                </tr>
                                <tr @if(strpos($RESULT_MOVE, 'FALHA') !== false) class="alert alert-danger" role="alert" @endif>
                                    <td>RESULT_MOVE_FILE</td>
                                    <td>
                                        {{$RESULT_MOVE}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>PAGE_ERRO_500</td>
                                    <td>
                                        <a href="../errors/500" >error.500</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>404</td>
                                    <td>
                                        <a href="../errors/404" >error.404</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
@stop