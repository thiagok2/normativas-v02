@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{route('home')}}">Painel</a></li>
        <li> <a href="#" class="active"><a href="#">Documentos</a></li>
    </ol>

    <div class="row">
        <div class="col-sm-12 mb-2 hidden">
            <a href="{{route('publicar')}}" class="btn btn-primary btn-lg">Publicar Novo</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Filtrar</div>
                <div class="panel-body">
                    <form class="form" method="GET" action="{{route('documentos-pesquisar')}}">
                        

                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="unidadeNome">Unidade/Usuário</label>
                                    <input type="text" id="unidadeNome" name="unidadeNome" class="form-control" value="{{$queryParams['unidadeQuery']}}"
                                            placeholder="Ex.: Alagoas, Maceió..." aria-describedby="basic-addon1"/>
                                        <input type="text" id="usuarioNome" name="usuarioNome" class="form-control"  value="{{$queryParams['usuarioNome']}}"
                                            placeholder="Ex.: Maria, João..." aria-describedby="basic-addon1"/>
                                        <small class="form-text text-muted">Nome/sigla do conselho e/ou nome do usuário</small>
                                    </div>
                                </div>
                           
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="periodoEnvio">Data Envio</label>
                                       
                                        <input class="form-control" type="date" id="dataInicioEnvio" name="dataInicioEnvio" value="{{$queryParams['dataInicioEnvio']}}"> 
                                        <input class="form-control" type="date" id="dataFimEnvio" name="dataFimEnvio" value="{{$queryParams['dataFimEnvio']}}">
                                        <small class="form-text text-muted">Data início e fim do envio no sistema</small>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="periodoPublicacao">Data Publicação</label>
                                        <input class="form-control" type="date" id="dataInicioPublicacao" name="dataInicioPublicacao" value="{{$queryParams['dataInicioPublicacao']}}"> 
                                        <input class="form-control" type="date" id="dataFimPublicacao" name="dataFimPublicacao" value="{{$queryParams['dataFimPublicacao']}}">
                                        <small class="form-text text-muted">Data início e fim do publicação</small>
                                    </div>
                                </div>

                            </div>
                            
                        </div>  

                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                        {!! csrf_field() !!}
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @include('admin.includes.alerts')

    <div class="row">
        <div class="col-sm-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Últimos documentos enviados</h3>
                    <br/>
                    <small class="form-text text-muted">Total de {{$documentos->total()}} registros</small>
                </div>
                    <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th style="width: 2%">Ano</th>
                                <th style="width: 8%">Número</th>
                                <th style="width: 6%">Tipo</th>
                                <th style="width: 20%">Título</th>
                                <th style="width: 6%">Publicação</th>
                                <th style="width: 6%">Envio</th>
                                <th style="width: 4%">Por</th>
                                <th style="width: 2%"></th>
                            </tr>
                        <thead>  
                        <tbody>
                            
                                @forelse ($documentos as $key=>$doc)
                                <tr>
                                    <td>
                                        {{ ($documentos->currentpage()-1) * $documentos->perpage() + $key + 1 }}
                                    </td>
                                    <td>{{$doc->ano}}</td>
                                    <td>{{$doc->numero}}</td>
                                    <td>{{$doc->tipoDocumento->nome}}</td>
                                    <td>{{$doc->titulo}}</td>
                                    <td>{{date('d-m-Y', strtotime($doc->data_publicacao))}}</td>
                                    <td>{{date('d-m-Y', strtotime($doc->data_envio))}}</td>
                                    <td>{{$doc->unidade->sigla}} - {{$doc->user->firstName()}}</td>
                                    <td>
                                        <a href="{{ route("pdfNormativa",$doc->arquivo) }}" target="_blank">
                                            <i class="fa fa-arrow-circle-down"></i>
                                        </a>
                                        <a href="{{ route("documento",$doc->id) }}">
                                            <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">
                                            <span class="no-results">Sem documentos enviados</span>
                                        </td>
                                    </tr>
                                @endforelse

                        </tbody>
                    </table>
                </div><!-- /.box-body --> 
                <div class="box-footer">
                    {{ $documentos->links() }}
                </div>
            </div>
        </div>
    </div>
    
@stop