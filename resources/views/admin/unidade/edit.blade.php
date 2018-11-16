@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Painel</a></li>
        <li> <a href="#" ><a href="#">Unidade</a></li>
    </ol>

    @include('admin.includes.alerts')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Atualizar Unidade</div>
            <div class="panel-body">
            <form name="form" id="form" method="post" action="{{route('unidade-store')}}">
                    {!! csrf_field() !!}
                    <input type="hidden" value="{{ $unidade->id }}" name="id">
                    <input type="hidden" value="{{ $unidade->estado_id }}" name="estado_id">
                    <input type="hidden" value="{{ $unidade->municipio_id }}" name="municipio_id">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" value="{{ $unidade->nome }}" name="nome">
                            </div>
                        </div>
        
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="sigla">Sigla</label>
                                <input type="text" class="form-control" value="{{ $unidade->sigla }}" name="sigla">
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <select class="form-control" required id="tipo" name="tipo">
                                    <option {{($unidade->tipo == 'Conselho' ? 'selected="selected"':'')}}>Conselho</option>
                                    <option {{($unidade->tipo == 'Outros' ? 'selected="selected"':'')}}>Outros</option>
                                </select>
                            </div>
                        </div>
        
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="esfera">Esfera</label>
                                <select class="form-control" required id="esfera" name="esfera">
                                    <option {{($unidade->esfera == 'Municipal' ? 'selected="selected"':'')}}>Municipal</option>
                                    <option {{($unidade->esfera == 'Estadual' ? 'selected="selected"':'')}}>Estadual</option>
                                    <option {{($unidade->esfera == 'Federal' ? 'selected="selected"':'')}}>Federal</option>
                                </select>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input type="text" class="form-control" value="{{ $unidade->telefone }}" name="telefone">
                            </div>
                        </div>
        
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <small class=".text-muted">(Separar emails com <b>;(ponto e virgula))</b></small>
                                <input type="text" class="form-control" value="{{ $unidade->email }}" name="email">
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="url">URL</label>
                                <small class=".text-muted">(Endereço online - opcional)</small>
                                <div class='input-group'>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-globe">
                                        </span>
                                    </span>
                                    <input type='url' class="form-control" id="url" name="url" value="{{ $unidade->url }}" maxlength="255"/>
                                </div>
                            </div>
                        </div>
                    </div><!--end row -->
        
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="endereco">Endereço</label>
                                <small class=".text-muted">(opcional)</small>
                                <input type='text' class="form-control" name="endereco" value="{{ $unidade->endereco }}" maxlength="255"/>
                            </div>
                        </div>
                    </div><!--end row -->
        
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="endereco">Contato</label>
                                <small class=".text-muted">(opcional)</small>
                                <input type='text' class="form-control" id="contato" name="contato" 
                                    value="{{ $unidade->contato }}" maxlength="255"/>
                            </div>
                        </div>
        
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="endereco">Contato 2</label>
                                <small class=".text-muted">(opcional)</small>
                                <textarea class="form-control" id="contato2" name="contato2" maxlength="255">{{ $unidade->contato2 }}</textarea>
                            </div>
                        </div>
                    </div><!--end row -->
        
                    <button type="submit" class="btn btn-primary btn-lg" value="Atualizar">Atualizar</button>
                    <a href="/" class="btn btn-danger btn-lg" value="Fechar">Fechar</a>
                </form>
            </div><!--end panel-body-->
        </div><!--end panel-->


        <div class="panel panel-default">
            <div class="panel-heading">Colaboradores</div>
            <div class="panel-body">
                <a href="/admin/unidades/adicionar/colaborador" class="btn btn-primary btn-lg" value="Fechar">Adicionar Colaborador</a>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Criado</th>
                                <th>Confirmado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->confirmado }}</td>
                            @empty
                            <tr>
                                <td colspan="5">Sem usuários</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
        </div>



    </div><!--end container-->
@stop