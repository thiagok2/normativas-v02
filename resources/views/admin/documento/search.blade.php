@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')

@stop

@push('css')

<style>
    /*EXTRA*/
    ul.legenda > li  {
        
        padding: 5px 5px;
       
    }
</style>

@endpush

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{route('home')}}">Painel</a></li>
        <li> <a href="#" class="active"><a href="#">Pesquisar Pendências</a></li>
    </ol>

    <div class="row">
        <div class="col-lg-6">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Filtrar</h3>
                </div>
                <div class="box-body">
                    <form class="form" method="GET" action="{{route('documentos-pesquisar-status')}}">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="unidadeNome">Unidade:</label>
                                        <input type="text" id="unidadeNome" name="unidadeNome" class="form-control" value="{{$queryParams['unidadeQuery']}}"
                                            placeholder="Ex.: Alagoas, Maceió..." aria-describedby="basic-addon1"/>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="tipo_entrada">Formato:</label>
                                        <select class="form-control select2" id="formato" name="formato">
                                            <option value="">Todos</option>
                                            @foreach ($listFormatos as $f)
                                                <option value="{{$f->formato}}" @if ($queryParams['formato'] == $f->formato) selected @endif>{{$f->formato}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="tipo_entrada">Médoto de Entrada:</label>
                                        <select class="form-control select2" id="tipo_entrada" name="tipo_entrada">
                                            <option value="">Todos</option>
                                            @foreach ($listTipoEntrada as $tipo)
                                                <option value="{{$tipo->tipo_entrada}}" @if ($queryParams['status'] == $tipo->tipo_entrada) selected @endif>{{$tipo->tipo_entrada}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select class="form-control select2" id="status" name="status">
                                            <option value="PENDENTE" @if ($queryParams['status'] == "PENDENTE") selected @endif>PENDENTES</option>
                                            @foreach ($listStatus as $status)
                                                <option value="{{$status->status_extrator}}" @if ($queryParams['status'] == $status->status_extrator) selected @endif>{{$status->status_extrator}}</option>
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary btn-lg">Pesquisar</button>
                        </div>

                       
                        {!! csrf_field() !!}
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="container">
                <div class="row">
                    <div class="box box-warning">
                        <div class="box-body">
                            <div class="col-md-3">
                                <ul class="list-group legenda">
                                    <li class="list-group-item active">
                                        Status
                                    </li>
                                    <li class="list-group-item">
                                        Cadastrado:
                                        <span class="small text-muted"> Metadados extraídos mas sem documento;</span>
                                    </li>
                                    <li class="list-group-item">
                                        Baixado: 
                                        <span class="small text-muted">Documento captura porém não publicado;</span>
                                    </li>
                                    <li class="list-group-item">
                                        Falha Download: <span class="small text-muted">Problemas ao baixar arquivo. Documento não enviado;</span>
                                    </li>
                                    <li class="list-group-item">
                                        Indexado:<span class="small text-muted"> Documento publicado para pesquisa;</span>
                                    </li>
                                    <li class="list-group-item">
                                        Falha Indexação(Elastic): <span class="small text-muted"> Não foi possível disponibilizar arquivo para pesquisa;</span>
                                    </li>
                                </ul>   
                            </div><!-- end col-->
                            <div class="col-md-3">
                                <ul class="list-group legenda">
                                    <li class="list-group-item active">
                                        Método de Inserção
                                    </li>
                                    <li class="list-group-item">
                                        Individual:
                                        <span class="small text-muted"> Inserção manual indivudual;</span>
                                    </li>
                                    <li class="list-group-item">
                                        Lote: 
                                        <span class="small text-muted">Inserção de multiplos arquivos;</span>
                                    </li>
                                    <li class="list-group-item">
                                        Extrator: 
                                        <span class="small text-muted">Extração via Robô;</span>
                                    </li>
                                </ul>   
                            </div><!-- end col-->
    
                        </div><!-- end box-body-->
                    </div><!-- end box -->
                </div>
            </div>
        </div>
    </div>

    @include('admin.includes.alerts')
    <div class="row">
        <div class="col-lg-12">
            <div class="alert bg-yellow alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>
                    <h4>Complete aqueles documentos que não se encontram indexados, ou seja, possuem status: 
                    <strong>CADASTRADO, BAIXADO OU EM FALHA.</strong> <br/>
                    Esses documentos se encontraram em destaque(vermelho).
                    </h4>
                </p>
            </div>
        </div>    
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="box box-warning">
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
                                <th>Ano</th>
                                <th>Documento</th>
                                <th>Tags</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                                @forelse ($documentos as $key=>$doc)
                                <tr @if ($doc->isIndexado()) class='bg-success' @else class='bg-danger' @endif>
                                    <td>
                                        {{ ($documentos->currentpage()-1) * $documentos->perpage() + $key + 1 }}
                                    </td>
                                    <td>{{$doc->ano}}</td>
                                    <td>{{$doc->titulo}}({{$doc->numero}})</td>
                                    <td>
                                        <span class="badge bg-secondary">{{$doc->formato}}</span>
                                        <span class="badge bg-secondary">{{$doc->tipo_entrada}}</span>
                                        <span class="badge bg-secondary">{{$doc->status()}}</span>
                                    </td>
                                    <td>
                                        @if ($doc->isIndexado())
                                            <a href="/normativa/view/{{ $doc['arquivo'] }}" target="_blank" title="Abrir no portal Normativas">
                                                <i class="fa fa-external-link"></i>
                                            </a>
                                       
                                            <a  target="_blank"  href="{{route('pdfNormativa',$doc->arquivo)}}" title="Download">
                                                <i class="fa fa-cloud-download"></i>
                                            </a>
                                        @elseif ($doc->isBaixado())
                                            <a href='{{ Storage::url("uploads/$doc->arquivo")}}' target="_blank" title="Download(local)">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        @endif

                                        <a href="{{ route("documento",$doc->id) }}" title="Visualizar">
                                            <i class="fa fa-eye" ></i>
                                        </a>
                                        <a href="{{ route("documento-edit",$doc->id) }}" title="Editar">
                                            <i class="fa fa-edit" ></i>
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
                    {{ $documentos->appends($queryParams)->links() }}
                </div>
            </div>
        </div>
    </div>

@stop
