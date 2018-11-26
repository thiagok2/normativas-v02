@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{route('home')}}">Painel</a></li>
        <li> <a href="#" class="active"><a href="#">Unidades</a></li>
    </ol>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Filtrar</div>
                    <div class="panel-body">
                    <form class="form-inline" method="GET" action="{{route('unidades')}}">
                            {!! csrf_field() !!}
                    <input type="text" id="nome" name="nome" class="form-control" value="{{$nome}}"
                                placeholder="Nome da unidade" aria-describedby="basic-addon1">
                            
                            <select class="form-control" name="esfera" id="esfera">
                                <option value="0">Todas as Esferas</option>
                                <option value="Federal"     @if($esfera=="Federal") selected @endif>Federal</option>
                                <option value="Estadual"    @if($esfera=="Estadual") selected @endif>Estadual</option>
                                <option value="Municipal"   @if($esfera=="Municipal") selected @endif>Municipal</option>    
                            </select>

                            <select class="form-control" name="estado" id="estado">
                                <option>Todos os Estados</option>
                                @foreach ($estados as $estado)
                                    <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn btn-primary">Pesquisar</button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-striped table-hover table-condensed">
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Sigla</th>
                                    <th>Tipo</th>
                                    <th>Esfera</th>
                                    <th>Ações</th>
                                </tr>
                                @forelse ($unidades as $unidade)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $unidade->nome }}</td>
                                        <td>{{ $unidade->sigla }}</td>
                                        <td>{{ $unidade->tipo }}</td>
                                        <td>{{ $unidade->esfera }}</td>
                                        <td>
                                            <a href="{{route("unidade-edit",$unidade->id)}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-envelope"></i>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop