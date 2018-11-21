@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
<ol class="breadcrumb">
    <li><a href="/">Painel</a></li>
    <li> <a href="{{route('usuarios')}}">Usuário</a></li>
    <li> <a href="#">Criar usuário</a></li>
</ol>
@include('admin.includes.alerts')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">Criar novo usuário</div>
                <div class="panel-body">
                    <form name="form" id="form" method="post" action="{{route('usuario-create')}}">
                        {!! csrf_field() !!}
                       
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="nome">Nome*</label>
                                    <input type="text" class="form-control" name="name"
                                        required maxlength="255" minlength="10">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                           <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="tipo">Tipo</label>
                                    <select class="form-control" id="tipo" name="tipo">
                                        @if (auth()->user()->isAdmin())
                                            <option value="admin">Administrador</option>
                                        @endif
                                        <option value="gestor">Gestor</option>
                                        <option value="colaborador">Colaborador</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="email">Email*</label>
                                    <small class=".text-muted"></small>
                                    <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-envelope-o">
                                            </span>
                                        </span>
                                        <input type='email' class="form-control" id="email" name="email"  maxlength="255"
                                            required/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg" value="Convidar">Enviar convite</button>
                        
                    </form>
                </div><!-- end panel-body-->
            </div><!-- end panel-->
        </div><!-- end col-form-->
    
    </div><!-- end row container-->
</div><!-- end container-->

@stop