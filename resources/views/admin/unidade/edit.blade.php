@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}">Painel</a></li>
        <li> <a href="#" ><a href="#">Unidade</a></li>
    </ol>

    @include('admin.includes.alerts')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Atualizar Unidade</div>
            <div class="panel-body">

                @if ( auth()->user()->isAdmin())
                    <p>
                        <a href="{{route('usuario-convidar',['unidade_id'=>$unidade->id])}}"  class="btn btn-primary btn-lg" value="Fechar">Adicionar Colaborador</a>
                    </p>
                @endif

                @if (auth()->user()->isGestor() && $unidade->confirmado)
                    <p>
                        <a href="{{route('usuario-convidar')}}"  class="btn btn-primary btn-lg" value="Fechar">Adicionar Colaborador</a>
                    </p>
                @endif
                <form name="form" id="form" method="post" action="{{route('unidade-store')}}">
                    {!! csrf_field() !!}
                    <input type="hidden" value="{{ $unidade->id }}" name="id">
                    <input type="hidden" value="{{ $unidade->estado_id }}" name="estado_id">
                    <input type="hidden" value="{{ $unidade->municipio_id }}" name="municipio_id">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nome">Nome*</label>
                                <input type="text" class="form-control" value="{{ $unidade->nome }}" name="nome"
                                    required maxlength="255" minlength="10">
                            </div>
                        </div>
        
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="sigla">Sigla*</label>
                                <input type="text" class="form-control" value="{{ $unidade->sigla }}" name="sigla"
                                    required minlength="3" maxlength="10">
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="tipo">Tipo*</label>
                                <select class="form-control" required id="tipo" name="tipo">
                                    <option value="Conselho" {{($unidade->tipo == 'Conselho' ? 'selected="selected"':'')}}>Conselho</option>
                                    <option value="Outros" {{($unidade->tipo == 'Outros' ? 'selected="selected"':'')}}>Outros</option>
                                </select>
                            </div>
                        </div>
        
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="esfera">Esfera*</label>
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
                                <small class=".text-muted">* (DDD) 0000-0000</b></small>
                                <input type="text" class="form-control" value="{{ $unidade->telefone }}" name="telefone"
                                    required maxlength="100" minlength="12">
                            </div>
                        </div>
        
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="email">Email*</label>
                                <small class=".text-muted">(Separar emails com <b>;(ponto e virgula))</b></small>
                                <input type="text" class="form-control" value="{{ $unidade->email }}" name="email"
                                    required maxlength="255">
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
                                    <input type='url' class="form-control" id="url" name="url" value="{{ $unidade->url }}" 
                                        maxlength="255"/>
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
                    <a href="{{route('home')}}" class="btn btn-danger btn-lg" value="Fechar">Fechar</a>
                </form>
            </div><!--end panel-body-->
        </div><!--end panel-->


        <div class="panel panel-default">
            <div class="panel-heading">Colaboradores</div>
            <div class="panel-body">
                @if ( auth()->user()->isAdmin())
                    <p>
                        <a href="{{route('usuario-convidar',['unidade_id'=>$unidade->id])}}"  class="btn btn-primary btn-lg" value="Fechar">Adicionar Colaborador</a>
                    </p>
                @endif

                @if (auth()->user()->isGestor() && $unidade->confirmado)
                    <p>
                        <a href="{{route('usuario-convidar')}}"  class="btn btn-primary btn-lg" value="Fechar">Adicionar Colaborador</a>
                    </p>
                @endif
                
                <div class="container">
                    <div class="row">
                        @forelse ($users as $user)
                            <div class="col-lg-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">{{ $user->name }}</div>
                                    <div class="panel-body">
                                        Email: {{ $user->email }}
                                        <br/>
                                        {{ $user->tipo }}
                                        <br/>
                                        Criação: {{ $user->created_at }}
                                        <br/>
                                        Confirmação: {{ $user->confirmado_em }}

                                    </div>
                                </div>   
                            </div>
                        @empty
                            <h2>Sem usuários</h2>
                        @endforelse                    
                    </div>
                </div>
            </div>
        </div>



    </div><!--end container-->
@stop