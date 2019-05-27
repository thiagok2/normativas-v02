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

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
                <div class="panel panel-default box box-primary">
                    <div class="panel-heading">Unidade</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label for="nome">Nome*</label>
                                    <input type="text" class="form-control" value="{{ $unidade->nome }}" name="nome"
                                        readonly>
                                </div>
                            </div>
            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="sigla">Sigla*</label>
                                    <input type="text" class="form-control" value="{{ $unidade->sigla }}" name="sigla"
                                        readonly>
                                </div>
                            </div>
                        </div> <!-- row nome/sigla -->

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="tipo">Tipo*</label>
                                    <select class="form-control" id="tipo" name="tipo" disabled>
                                        <option value="Conselho" {{($unidade->tipo == 'Conselho' ? 'selected="selected"':'')}}>Conselho</option>
                                        <option value="Outros" {{($unidade->tipo == 'Outros' ? 'selected="selected"':'')}}>Outros</option>
                                    </select>
                                </div>
                            </div>
            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="esfera">Esfera*</label>
                                    <select class="form-control" id="esfera" name="esfera" disabled>
                                        <option {{($unidade->esfera == 'Municipal' ? 'selected="selected"':'')}}>Municipal</option>
                                        <option {{($unidade->esfera == 'Estadual' ? 'selected="selected"':'')}}>Estadual</option>
                                        <option {{($unidade->esfera == 'Federal' ? 'selected="selected"':'')}}>Federal</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="telefone">Telefone</label>
                                    <small class=".text-muted">* (DDD) 0000-0000</b></small>
                                    <input type="text" class="form-control" value="{{ $unidade->telefone }}" name="telefone"
                                        readonly>
                                </div>
                            </div>
            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="email">Email*</label>
                                    <small class="text-muted">(Separar emails com <b>;(ponto e virgula))</b></small>
                                    <input type="text" class="form-control" value="{{ $unidade->email }}" name="email"
                                        required maxlength="255">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="url">URL</label>
                                    <small class="text-muted">(Endereço online)</small>
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

                     </div>
                </div>
            </div><!-- end col 9 --> 
            <div class="col-lg-3">
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
            </div>
        </div><!-- end row main --> 
    </div> <!-- end container --> 
@stop