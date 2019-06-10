@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')

    
@stop

@section('content')    
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">Painel</a></li>
            <li><a href="{{route('Assuntos')}}">Assuntos</a></li>
            <li><a href="#">Editar</a></li>
        </ol>
        <div class="page-header">
            <a href="{{route('assuntos-create')}}" class="btn btn-primary btn-lg">Novo Assunto</a>
        </div>
        
        <div class="row">
            @include('admin.includes.alerts')
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Editar Assunto:</b> Informe nome e descrição</div>
                    <div class="panel-body">
                    @if (isset($assunto->deleted_at))
                        <div class="alert alert-warning">
                            Assunto desabilitado em {{date('d/m/Y H:i:s', strtotime($assunto->deleted_at))}}
                        </div>
                    @endif
                    <form  name="form" id="form" method="post" action="{{route('assunto-store')}}"> 
                        {!! csrf_field() !!}

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="id">Id*</label>
                                <input type="text" class="form-control" value="{{$assunto->id}}" name="id" id="id"
                                    readonly maxlength="100" minlength="10">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="nome">Nome*</label>
                                <input type="text" class="form-control" value="{{$assunto->nome}}" name="nome" id="nome"
                                    required maxlength="100" minlength="10" @if (isset($assunto->deleted_at)) readonly @endif >
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="descricao">Descrição*</label>
                                <textarea class="form-control" rows="10" name="descricao" id="descricao" @if (isset($assunto->deleted_at)) readonly @endif>{{ $assunto->descricao }}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg " value="Salvar">Salvar</button>
                        @if (isset($assunto->deleted_at))
                            <a href="{{route('assunto-restore', $assunto->id)}}" class="btn btn-warning btn-lg pull-right" value="Habilitar">Habilitar</a>
                        @else
                            <a href="{{route('assunto-delete', $assunto->id)}}" class="btn btn-danger btn-lg pull-right" value="Excluir">Excluir</a>
                        @endif
                        
                    </form>
                    </div><!-- end panel-body-->
                </div><!-- end panel-->
            </div><!-- end col-8 main-->
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Assuntos cadastrados</div>
                    <div class="panel-body">
                        <div class="list-group">
                            @foreach ($assuntos as $a)
                                
                                <a href="{{route('assunto-edit',$a->id)}}" class="list-group-item @if ($a->id == $assunto->id) active @endif">
                                    <span class="list-group-item-text">
                                    {{$a->nome}}
                                    ({{$a->documentos_count}})
                                    </span>

                                    <span class="pull-right">
                                        <i class="fa fa-edit"></i>
                                    </span>
                                </a>
                                
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end row main-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                <div class="panel-heading">Documentos associados a {{$assunto->nome}} ({{$documentos->total()}})</div>
                    <div class="panel-body">
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 1%">#</th>
                                    <th style="width: 2%">Ano</th>
                                    <th style="width: 3%">Número</th>
                                    <th style="width: 8%">Tipo</th>
                                    <th style="width: 30%">Título</th>
                                    <th style="width: 6%">Publicação</th>
                                    <th style="width: 6%">Envio</th>
                                    <th style="width: 4%">Por</th>
                                    <th style="width: 2%"></th>
                                </tr>
                            </thead> 
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
                                            <span class="no-results">Sem documentos associados</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer">
                        {{ $documentos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end container-->
@stop