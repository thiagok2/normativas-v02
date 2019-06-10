@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">Painel</a></li>
            <li> <a href="#" class="active"><a href="#">Usuários</a></li>
        </ol>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Filtrar</div>
                    <div class="panel-body">
                        <form class="form-inline" method="GET" action="{{route('usuario-search')}}">
                            {!! csrf_field() !!}
                            <input type="text" id="q" name="q" class="form-control" 
                                value='{{$q}}'
                                placeholder="Nome ou email" aria-describedby="basic-addon1">

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
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Unidade</th>
                                    <th>Confirmado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($usuarios as $u)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{$u->name}}</td>
                                    <td>{{$u->email}}</td>
                                    <td>{{$u->unidade->nome}}</td>
                                    <td>{{$u->confirmado_em}}</td>
                                    <td>
                                        @if (auth()->user()->id != $u->id && (auth()->user()->isGestor() || auth()->user()->isAdmin()))

                                    <a href="{{route('usuario-reconvidar',$u->id)}}" class="btn 
                                        {{$u->confirmado_em !== null ? 'btn-primary':'btn-danger'}} ">Enviar novo convite</a>    
                                        @endif
                                    </td>
                                </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                        <div class="box-footer">
                            {{ $usuarios->links() }}
                        </div>
                    </div>
                </div>
            </div>
    </div>
@stop