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
                    <a href="{{route('unidade-create')}}" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Adicionar Conselho</a>
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
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Esfera</th>
                                    <th>Estado</th>
                                    <th>Município</th>                                    
                                    <th>Nome da Unidade</th>
                                    <th class="col-md-1 text-center">Documentos</th>                                                                        
                                    <th class="col-md-1 text-center">Status</th>
                                    <th class="col-md-1 text-center">Editar</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 110%">
                                @forelse ($unidades as $key=>$unidade)                                                                                                                
                                    <tr @if ($unidade->documentos_count > 0 && $unidade->responsavel->confirmado) class='bg-success' @endif>
                                        <td class="text-bold">{{ ($unidades->currentpage()-1) * $unidades->perpage() + $key + 1 }}</td>
                                        <td>{{ $unidade->esfera }}</td>
                                        <td>{{ $unidade->estado['nome']}}</td>
                                        <td>[ Município ]</td>
                                        <td><a href="{{route("unidade-show",$unidade->id)}}">{{ $unidade->nome}}</a></td>                                        
                                        <td class="text-center">                                            
                                            @if($unidade->documentos_count > 0)
                                                <h4><span class="label label-success">{{$unidade->documentos_count}} <i class="fa fa-file"></i></span></h4>
                                            @else
                                                <h4><span class="label label-danger">{{$unidade->documentos_count}} <i class="fa fa-file"></i></span></h4>
                                            @endif                                                                                        
                                        </td>                                        
                                        <td class="text-center">                                            
                                            @if ($unidade->responsavel->confirmado)                                            
                                                <h4><span class="label label-success">CONFIRMADO</span></h4>
                                            @else
                                                <h4><span class="label label-danger">NÃO CONFIRMADO</span></h4>
                                            @endif                                                                                                                                    
                                        </td>                                        
                                        <td class="text-center">   
                                            <h4>                                        
                                                <a href="{{route("unidade-edit",$unidade->id)}}">
                                                    <span class="label label-primary"><i class="fa fa-edit"></i></span>
                                                </a>                                                                   
                                            </h4>                                                                 
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
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@stop
