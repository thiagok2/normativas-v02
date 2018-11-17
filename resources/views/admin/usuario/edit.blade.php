@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
<ol class="breadcrumb">
    <li><a href="/">Painel</a></li>
    <li> <a href="{{route('unidades')}}">Unidade</a></li>
    <li> <a href="#">Usuário</a></li>
</ol>
@include('admin.includes.alerts')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">Atualizar cadastro</div>
                <div class="panel-body">
                    <form name="form" id="form" method="post" action="{{route('usuario-store')}}">
                        {!! csrf_field() !!}
                        <input type="hidden" value="{{ $user->id }}" name="id">
                    
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" value="{{ $user->name }}" name="name">
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
                                        <input type='email' class="form-control" id="email" name="email" value="{{ $user->email }}" maxlength="255"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cpf">CPF</label>
                                    <input type="text" class="form-control" value="{{ $user->cpf}}" name="cpf">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="email2">Confirmar email</label>
                                    <small class=".text-muted"></small>
                                    <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-envelope-o">
                                            </span>
                                        </span>
                                        <input type='email' class="form-control" id="email2" name="email2" maxlength="255"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password">Senha</label>
                                    <small class=".text-muted"></small>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password2">Confirmar senha</label>
                                    <input type="password" class="form-control" name="password2">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg" value="Atualizar">Atualizar</button>
                        @if ($user->confirmado)
                            <a href="/" class="btn btn-danger btn-lg" value="Fechar">Fechar</a>
                        @endif
                       

                    </form>
                </div><!-- end panel-body-->
            </div><!-- end panel-->
        </div><!-- end col-form-->
    
    </div><!-- end row container-->
</div><!-- end container-->


@stop