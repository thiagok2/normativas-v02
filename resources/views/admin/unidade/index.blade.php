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
            @include('admin.includes.alerts')
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
                        <table id="tbl-conselhos" class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Esfera</th>
                                    <th>Estado</th>
                                    <th>Município</th>                                    
                                    <th>Nome da Unidade</th>
                                    <th class="col-md-1 text-center">Documentos</th>                                                                        
                                    <th class="col-md-1 text-center">Status</th>
                                    <th class="col-md-1 text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 110%">
                                @forelse ($unidades as $key=>$unidade)                                                                                                                
                                    <tr @if ($unidade->documentos_count > 0 && $unidade->responsavel->confirmado) class='bg-success' @endif>
                                        <td class="text-bold">{{ ($unidades->currentpage()-1) * $unidades->perpage() + $key + 1 }}</td>
                                        <td>{{ $unidade->esfera }}</td>
                                        <td>{{ $unidade->estado['nome']}}</td>
                                        <td>{{ $unidade->municipio['nome']}}</td>
                                        <td>
                                            <a style="cursor: pointer;" @if (!$unidade->confirmado) class="modal-unidade" @else href="{{route("unidade-show",$unidade->id)}}" @endif data-conselho-id="{{ $unidade->id }}">{{ $unidade->nome}}</a></td>                                        
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
                                                <a href="{{route("unidade-edit",$unidade->id)}}" title="Editar">
                                                    <span class="label label-primary"><i class="fa fa-edit"></i></span>
                                                </a>    
                                                
                                                <a href="#" 
                                                    title="Enviar convite" class="modal-unidade" data-conselho-id="{{ $unidade->id }}">
                                                    <span class="label label-primary"><i class="glyphicon glyphicon-send"></i></span>
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

    <div class="modal fade" id="modalAtualizarConvidar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="width: 80%;">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{route("unidade-novo-acesso")}}" method="POST" id="form-novo-acesso">
                {!! csrf_field() !!}
                <input type="hidden" name="unidade_id" id="unidade_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="conselho_titulo"></h4>
                        <span class="help-text text-muted">Edite as informações do gestor e envio um convite para liberar o acesso.</span>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <label for="conselho_nome">Conselho *</label>
                                        <input type="text" class="form-control" name="conselho_nome" id="conselho_nome"
                                        required maxlength="255" minlength="10">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="conselho_sigla">Sigla*</label>
                                        <input type="text" class="form-control" name="conselho_sigla" id="conselho_sigla" required minlength="3" maxlength="10">
                                    </div>
                                </div>                                                       
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="gestor_nome">Responsável</label>
                                    
                                        <input type="text" class="form-control" name="gestor_nome" id="gestor_nome" required maxlength="255" minlength="10">
                                    
                                        <small id="gestor_nome_help" class="help-text form-text text-muted">Nome do gestor na plataforma Normativas.</small>                                
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="gestor_email">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">
                                                <span class="glyphicon glyphicon-globe"></span>
                                            </span>
                                            <input type="email" class="form-control" name="gestor_email" id="gestor_email" required maxlength="255" minlength="10">
                                        </div>
                                        
                                        <small id="gestor_email_help" class="help-text form-text text-muted">Este email receberá uma nova senha de acesso caso seja enviado um novo convite.</small>                                
                                    </div>
                                </div> 
                            </div>
                        </div> <!-- end container-fluid-->
                    </div> <!-- end modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary btn-lg">Atualizar e Enviar Convite</button>
                    </div>
                
                </div> <!-- end modal-content -->
            </form>
        </div>
    </div>
@stop
@push('scripts')
    <script src="{{ asset('js/app-unidades.js') }}"></script>
@endpush