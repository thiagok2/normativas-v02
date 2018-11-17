@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
<ol class="breadcrumb">
    <li><a href="/">Painel</a></li>
    <li> <a href="{{route('usuarios')}}" class="active">Usuário</a></li>
</ol>
@include('admin.includes.alerts')
<div class="container">
    @if (auth()->user()->isAdmin() || auth()->user()->isGestor())
        <div class="row">
            <div class="col-lg-8">
                <a href="/" class="btn btn-primary btn-lg">Novo colaborador</a>
                <p>
            </div>
        </div>
    @endif
    
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">Perfil</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" name="name" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="unidade">Unidade</label>
                                <input type="text" readonly class="form-control" value="{{ $user->unidade->nome }} - {{ $user->unidade->sigla }}" name="unidade">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <select class="form-control" disabled id="tipo" name="tipo">
                                    <option {{($user->tipo == 'admin' ? 'selected="selected"':'')}}>Administrador</option>
                                    <option {{($user->tipo == 'gestor' ? 'selected="selected"':'')}}>Gestor</option>
                                    <option {{($user->tipo == 'colaborador' ? 'selected="selected"':'')}}>Colaborador</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <small class=".text-muted"></small>
                                <div class='input-group'>
                                    <span class="input-group-addon">
                                        <span class="fa fa-envelope-o">
                                        </span>
                                    </span>
                                    <input type='email' readonly class="form-control" id="email" name="email" value="{{ $user->email }}" maxlength="255"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" readonly class="form-control" value="{{ $user->cpf}}" name="cpf">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            @if (auth()->user()->id == $user->id)
                            <a href="{{route('usuario-edit',$user->id)}}" class="btn btn-primary btn-lg pull-left">Editar</a>    
                            @endif
                            
                            
                            <a href="/" class="btn btn-primary btn-lg pull-right" value="Fechar">Fechar</a>
                        </div>
                    </div>
                </div><!-- end panel-body-->
            </div><!-- end panel-->
        </div><!-- end col-form-->

        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">Outros usuáios da unidade</div>
                <div class="panel-body">
                    <div class="list-group">
                        @foreach ($usuarios as $u)
                            <a href="{{route('usuarios',['id' => $u->id])}}" class="list-group-item @if ($u->id == $user->id) active @endif">
                                <h4 class="list-group-item-heading">{{$u->name}}</h4>
                                <p class="list-group-item-text">
                                    {{$u->email}}
                                    <span class="badge pull-right">{{$u->tipo}}</span>
                                </p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end row -->

    <div class="row">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">Documentos enviados</div>
                <div class="panel-body">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th style="width: 2%">Ano</th>
                                <th style="width: 4%">Número</th>
                                <th style="width: 4%">Tipo</th>
                                <th style="width: 20%">Título</th>
                                <th style="width: 5%">Tags</th>
                                <th style="width: 5%">Publicação</th>
                                <th style="width: 5%">Envio</th>
                                <th style="width: 5%">Por</th>
                                <th style="width: 4%"></th>
                            </tr>
                        <thead>  
                        <tbody>
                            
                                @foreach ($documentos as $doc)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
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
                                    <td>{{$doc->user->firstName()}}</td>
                                    <td>
                                        <a href="{{ url("storage/uploads/{$doc->arquivo}") }}" target="_blank">
                                            <i class="fa fa-arrow-circle-down"></i>
                                        </a>
                                        <a href="{{ url("documento/{$doc->id}") }}">
                                            <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                        </tbody>
                    </table>
                    <div class="box-footer">
                        {{ $documentos->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div><!-- end container -->


@stop