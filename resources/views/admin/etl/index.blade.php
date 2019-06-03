@extends('adminlte::page')

@section('title', 'Importação de documentos')

@section('content_header')
    
@stop

@section('content')
    

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Scripts ETL</a>
            </h3>
            (Clique e execute)
        </div>
        <div class="box-body">
            <div class="container-fluid">
                <div class="row">
                    @foreach ($scripts as $script)
                        <a class="btn btn-primary btn-lg" href="{{route('etl-executar', [$script])}}">
                            <i class="fa fa-play"></i> {{$script}}
                        </a>
                    @endforeach
                </div>
            </div>
            
            
           
        </div>
        <div class="box-footer">
            <div class="alert alert-info">
                Não há monitoramento em tempo real via plataforma, o comando será apenas executados e seus logs poderão ser baixados 
                nos links abaixo;
            </div>
        </div>
    </div>

    <div class="box">
            <div class="box-header">
                <h3 class="box-title">Logs</a>
                </h3>
                (Clique e baixe)
            </div>
            <div class="box-body">
                
                @foreach ($logs as $log)
                <a class="btn btn-lg" href="{{route('download-log', [$log['filename']])}}">
                        <i class="fa fa-file-code-o"></i> {{$log['filename']}} <small>({{$log['size']}} MB)</small>
                    </a>
                @endforeach
            </div>
        </div>

@stop