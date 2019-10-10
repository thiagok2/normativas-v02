@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')    
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">Painel</a></li>
            <li> <a href="{{route('unidades')}}" >Unidades</a></li>
            <li> <a href="#" ><a href="#">Visualizar dados da Unidade</a></li>
        </ol>

        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default box">
                    <div class="panel-heading">
                        Unidade                                                
                        @if (isset($alerta))
                            <span class="align-middle pull-right label label-warning" style="font-size: 95%">
                                {{$alerta}}
                            </span>                    
                        @endif                          
                    </div>
                    <div class="panel-body">
                        <div class="row">                                        
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="esfera">Esfera</label>
                                    <select class="form-control" id="esfera" name="esfera" disabled>
                                        <option {{($unidade->esfera == 'Municipal' ? 'selected="selected"':'')}}>Municipal</option>
                                        <option {{($unidade->esfera == 'Estadual' ? 'selected="selected"':'')}}>Estadual</option>
                                        <option {{($unidade->esfera == 'Federal' ? 'selected="selected"':'')}}>Federal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estado_id">Estado</label>    
                                    <select class="form-control" id="estado_id" name="estado_id" disabled>
                                        <option>{{$unidade->estado['nome']}}</option>                                        
                                    </select>
                                </div>
                            </div><!-- end col estado-->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="municipio">Município</label>
                                    <select class="form-control" id="municipio_id" name="municipio_id" disabled>
                                        <option>Selecione</option>                                        
                                    </select>
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" value="{{ $unidade->nome }}" name="nome"
                                        readonly>
                                </div>
                            </div>
            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="sigla">Sigla</label>
                                    <input type="text" class="form-control" value="{{ $unidade->sigla }}" name="sigla"
                                        readonly>
                                </div>
                            </div>
                        </div> <!-- row nome/sigla -->                                               

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="friendly_url">URL Amigável</label>
                                                                        
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                            <span class="glyphicon glyphicon-globe"></span>
                                        </span>
                                        <input type="text" class="form-control" value="{{ $unidade->friendly_url }}" name="friendly_url" id="friendly_url"
                                            required maxlength="255" minlength="10" readonly>
                                    </div>
                                    
                                    <small id="friendly_url_help" class="form-text text-muted">URL Interna para a plataforma normativas</small>                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="telefone">Telefone</label>                                    
                                    <input type="text" class="form-control" value="{{ $unidade->telefone }}" name="telefone"
                                        readonly>
                                </div>
                            </div>
            
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <label for="email">Email</label>                                    
                                    <input type="text" class="form-control" value="{{ $unidade->email }}" name="email"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="url">Endereço na web</label>                                    
                                    <div class='input-group'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-globe">
                                            </span>
                                        </span>
                                        <input type='url' class="form-control" id="url" name="url" value="{{ $unidade->url }}" 
                                          readonly/>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row -->

                        <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="endereco">Endereço</label>                                        
                                        <input type='text' class="form-control" name="endereco" value="{{ $unidade->endereco }}" readonly/>
                                    </div>
                                </div>
                            </div><!--end row -->
                
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="endereco">Gestor</label>                                        
                                        <input type='text' class="form-control" id="contato" name="contato" 
                                            value="{{ $unidade->contato }}" readonly/>
                                    </div>
                                </div>
                            </div><!--end row -->

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="endereco">Outros cargos/responsáveis</label>                                        
                                        <textarea class="form-control" id="contato2" name="contato2" readonly>{{ $unidade->contato2 }}</textarea>
                                    </div>
                                </div>
                            </div><!--end row -->

                        <a href="{{route("unidade-edit",$unidade->id)}}" class="btn btn-primary" value="Atualizar dados da Unidade">Atualizar dados da Unidade</a>
                     </div>
                </div>
            </div><!-- end col 9 --> 
            <div class="col-lg-4">
                <div class="small-box bg-light-blue">
                    <div class="inner">
                        <h3>{{$documentosCount}}</h3>
    
                        <p>Total de Documentos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="small-box-footer">
                        <i class="fa fa-arrow-circle-right"></i>
                    </div>
                </div>
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{$documentosPendentesCount}}</h3>
    
                        <p>Pendentes</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="small-box-footer">
                        <i class="fa fa-arrow-circle-right"></i>
                    </div>
                </div>
                @if (sizeof($statusExtrator) > 0 )
                    <div class="panel panel-default box box-danger">
                        <div class="panel-heading">Status Extrator</div>
                        <div class="panel-body">
                            <table class="table table-striped table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($statusExtrator as $s)
                                        <tr>
                                            <td>{{ $s->status}}</td>
                                            <td>{{ $s->total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif


              
                <div class="panel panel-default">
                    <div class="panel-heading">Colaboradores</div>
                    <div class="panel-body">
                        @forelse ($users as $user)
                            
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    {{ $user->name }}                                    
                                </div>
                                <div class="panel-body">
                                    Email: {{ $user->email }}
                                    <br/>
                                    {{ $user->tipo }}
                                    <br/>
                                    @if($user->created_at)
                                        Criação: {{ $user->created_at->format('d/m/Y') }}
                                        <br/>
                                    @endif  
                                    @if ( $user->confirmado)
                                        Confirmação: {{ $user->confirmado_em }}
                                    @else
                                        <span class="badge">Não confirmado</span>
                                    @endif                                    
                                </div>
                                <div class="panel-footer">                                    
                                    @if (auth()->user()->isResponsavel() || auth()->user()->isAdmin())
                                        <a href="{{route('usuario-edit',$user->id)}}" class="btn btn-primary">Editar</a>                                            
                                    @endif                                    
                                </div>
                            </div>   
                            
                        @empty
                            <h2>Sem usuários</h2>
                        @endforelse                      
                    </div>
                </div>
               
            
            
            </div> <!-- end div-col-3 lateral-->

        </div><!-- end row main --> 
    </div> <!-- end container --> 
@stop