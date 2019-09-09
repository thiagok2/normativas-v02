@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')

@stop

@section('content')    
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">Painel</a></li>
            <li> <a href="#" class="active"><a href="#">Unidades</a></li>
        </ol>
        <div class="row">
            @if (auth()->user()->isAdmin())
                
                <div class="col-lg-2">
                    <a href="{{route('unidade-create')}}" class="btn btn-primary btn-block btn-lg">Novo Conselho</a>
                    <p>
                </div>
               
            @endif
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Filtrar</div>
                    <div class="panel-body">
                        <form class="form-inline" method="GET" action="{{route('unidades')}}">

                            <input type="text" id="nome" name="nome" class="form-control" value="{{$nome}}"
                                placeholder="Nome da unidade" aria-describedby="basic-addon1">

                            <select class="form-control" name="esfera" id="esfera">
                                <option value="0">Todas as Esferas</option>
                                <option value="Federal"     @if($esfera=="Federal") selected @endif>Federal</option>
                                <option value="Estadual"    @if($esfera=="Estadual") selected @endif>Estadual</option>
                                <option value="Municipal"   @if($esfera=="Municipal") selected @endif>Municipal</option>
                            </select>

                            <select class="form-control" name="estado" id="estado">
                                <option value=0>Todos os Estados</option>
                                @foreach ($estados as $e)
                                    <option value="{{$e->id}}" @if($estado==$e->id) selected @endif>{{$e->nome}}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn btn-primary">Pesquisar</button>
                            {!! csrf_field() !!}
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                            Resultados ({{$unidades->total()}})
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover table-condensed">
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Estado</th>
                                    <th>Sigla</th>
                                    <th>Tipo</th>
                                    <th>Esfera</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                                @forelse ($unidades as $key=>$unidade)
                                    <tr @if ($unidade->documentos_count > 0 && $unidade->responsavel->confirmado) class='bg-success' @endif>
                                        <td>{{ ($unidades->currentpage()-1) * $unidades->perpage() + $key + 1 }}</td>
                                        <td>
                                            <a href="{{route("unidade-show",$unidade->id)}}">
                                                {{ $unidade->nome }}
                                            </a>
                                            
                                        </td>
                                        <td>{{ $unidade->estado['nome']}}</td>
                                        <td>{{ $unidade->sigla }}</td>
                                        <td>{{ $unidade->tipo }}</td>
                                        <td>{{ $unidade->esfera }}</td>
                                        <td style="float:left;">
                                            {{ $unidade->documentos_count }}
                                            <i class="fa fa-file {{$unidade->documentos_count > 0 ? 'icon-success':'icon-danger'}}"></i>
                                            <i class="fa fa-user {{$unidade->responsavel->confirmado ? 'icon-success':'icon-danger'}}"></i>
                                        </td>
                                        <td>
                                            <a href="{{route("unidade-edit",$unidade->id)}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Sem resultados</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6 no-padding">
                                    {{ $unidades->appends(request()->query())->links() }}
                                </div>
                                <div class="col-lg-3 pull-right no-padding  ">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <i class="glyphicon glyphicon-file"></i>
                                            Documentos enviados

                                        </li>
                                        <li class="list-group-item">
                                                <i class="glyphicon glyphicon-user"></i>
                                            Usuário confirmou acesso
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@stop
