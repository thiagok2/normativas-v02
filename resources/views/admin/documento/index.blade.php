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
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="unidadeNome">Unidade:</label>
                                        <input type="text" id="unidadeNome" name="unidadeNome" class="form-control" value="{{$queryParams['unidadeQuery']}}"
                                            placeholder="Ex.: Alagoas, Maceió..." aria-describedby="basic-addon1"/>
                                        <br/>
                                        <label for="usuarioNome">Usuário:</label>
                                        <input type="text" id="usuarioNome" name="usuarioNome" class="form-control"  value="{{$queryParams['usuarioNome']}}"
                                            placeholder="Ex.: Maria, João..." aria-describedby="basic-addon1"/>
                                        <small class="form-text text-muted">Nome/sigla do conselho e/ou nome do usuário</small>
                                    </div>
                                </div>
                           
                                <div class="col-lg-2">

                                    <div class="form-group">
                                        <label for="dataInicioEnvio">Data de Envio (Início):</label>
                                        <input class="form-control" type="date" id="dataInicioEnvio" name="dataInicioEnvio" value="{{$queryParams['dataInicioEnvio']}}">
                                        <br/>
                                        <label for="dataFimEnvio">Data de Envio (Fim):</label>
                                        <input class="form-control" type="date" id="dataFimEnvio" name="dataFimEnvio" value="{{$queryParams['dataFimEnvio']}}">
                                        <small class="form-text text-muted">Data início e fim do envio no sistema</small>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="dataInicioPublicacao">Data de Publicação (Início):</label>
                                        <input class="form-control" type="date" id="dataInicioPublicacao" name="dataInicioPublicacao" value="{{$queryParams['dataInicioPublicacao']}}">
                                        <br/>
                                        <label for="dataFimPublicacao">Data de Publicação (Fim):</label>
                                        <input class="form-control" type="date" id="dataFimPublicacao" name="dataFimPublicacao" value="{{$queryParams['dataFimPublicacao']}}">
                                        <small class="form-text text-muted">Data início e fim do publicação</small>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="numero">Número:</label>
                                        <input class="form-control" id="numero" name="numero" value="{{$queryParams['numero']}}" placeholder="CEE-AL 2/2019">               
                                        <br/>
                                        <label for="arquivo">Nome:</label>
                                        <input class="form-control" id="arquivo" name="arquivo" value="{{$queryParams['arquivo']}}" placeholder="Nome do arquivo">
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="tipo_entrada">Entrada:</label>
                                        <select class="form-control select2" id="tipo_entrada" name="tipo_entrada">
                                            <option value="">Todos</option>
                                            <option value="manual" @if ($queryParams['tipo_entrada'] == 'manual') selected @endif>Manual</option>
                                            <option value="extrator" @if ($queryParams['tipo_entrada'] == 'extrator') selected @endif>Extrator</option>
                                        </select>
                                        <br/>
                                        <label for="status">Completo:</label>
                                        <select class="form-control select2" id="status" name="status">
                                            <option value="">Todos</option>
                                            <option value="indexado" @if ($queryParams['status'] == 'indexado') selected @endif>Indexado</option>
                                            <option value="pendente" @if ($queryParams['status'] == 'pendente') selected @endif>Pendente</option>
                                        </select>
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
                    <h3 class="box-title">Documentos pesquisados</h3>
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
                                <th style="width: 20%">Documento</th>
                                <th style="width: 20%">Tags</th>
                                <th style="width: 10%">Publicação</th>
                                <th style="width: 10%">Envio</th>
                                <th style="width: 10%">Por</th>
                                <th style="width: 2%"></th>
                            </tr>
                        </thead>
                        <tbody>

                                @forelse ($documentos as $key=>$doc)
                                <tr @if ($doc->completed) class='bg-success' @else class='bg-warning' @endif>
                                    <td>
                                        {{ ($documentos->currentpage()-1) * $documentos->perpage() + $key + 1 }}
                                    </td>
                                    <td>{{$doc->ano}}</td>
                                    <td>{{$doc->numero}}</td>
                                    <td>{{$doc->tipoDocumento->nome}}</td>
                                    <td>{{$doc->titulo}}</td>
                                    <td>
                                        @foreach ($doc->palavrasChaves as $p)
                                            <span class="badge bg-secondary">{{$p->tag}}</span>
                                        @endforeach
                                    </td>
                                    <td>{{date('d-m-Y', strtotime($doc->data_publicacao))}}</td>
                                    
                                    <td>{{date('d-m-Y', strtotime($doc->data_envio))}}</td>
                                    
                                    <td>{{$doc->unidade->sigla}} - {{$doc->user->firstName()}}</td>
                                    <td>
                                        <div style="width:80px">
                                        @if ($doc->completed)
                                            <a  target="_blank"  href="{{route('pdfNormativa',$doc->arquivo)}}">
                                                <i class="fa fa-download" title="Download"></i>
                                            </a>
                                        @else
                                            <a href='{{ Storage::url("uploads/$doc->arquivo")}}' target="_blank">
                                                <i class="fa fa-download" title="Download"></i>
                                            </a>
                                        @endif

                                        <a href="{{ route("documento",$doc->id) }}">
                                            <i class="fa fa-eye" title="Visualizar"></i>
                                        </a>
                                        <a href="{{ route("documento-edit",$doc->id) }}">
                                            <i class="fa fa-edit" title="Editar"></i>
                                        </a>
                                        </div>
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
