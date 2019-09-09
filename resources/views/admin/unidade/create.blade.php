@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">Painel</a></li>
            <li> <a href="{{route('unidades')}}" >Unidades</a></li>
            <li> <a href="#" ><a href="#">Nova Unidade</a></li>
        </ol>

        @include('admin.includes.alerts')

        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Nova Unidade</div>
                    <div class="panel-body">
                    <form name="form" id="form" method="post" action="{{route('unidade-save')}}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="tipo" id="tipo" value="Conselho"/>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="tipo">Esfera*</label>
                                        <select class="form-control" required id="esfera" name="esfera" required>
                                            <option value="Municipal" selected>Municipal</option>
                                            <option value="Estadual" disabled>Estadual</option>
                                            <option value="Federal" disabled>Federal</option>
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="estado_id">Estado</label>
        
                                        <select class="form-control" required id="estado_id" name="estado_id" required>
                                            <option>Selecione</option>
                                            @foreach ($estados as $estado)
                                                <option value="{{$estado->sigla}}" {{ old('estado_id') == $estado->id ? "selected":""}}>{{$estado->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- end col estado-->
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="municipio">Município</label>
        
                                        <select class="form-control" required id="municipio_id" name="municipio_id" required>
                                            <option>Selecione</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div><!-- end estados/municipios-->
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <label for="nome">Nome*</label>
                                        <input type="text" class="form-control" value="{{ $unidade->nome }}" name="nome" id="nome"
                                            required maxlength="255" minlength="10" placeholder="Ex.: CONSELHO MUNICIPAL DE EDUCAÇÃO DE MACEIÓ">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="sigla">Sigla*</label>
                                        <input type="text" class="form-control" value="{{ $unidade->sigla }}" name="sigla"
                                            required minlength="3" maxlength="10" placeholder="Ex.: COMED-MACEIO">
                                    </div>
                                </div>
        
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label for="friendly_url">URL Amigável</label>
                                        <a class="btn btn-sm" id="btn_edit_url_amigavel">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">
                                                <span class="glyphicon glyphicon-globe"></span>
                                            </span>
                                            <input type="text" class="form-control" value="{{ $unidade->friendly_url }}" name="friendly_url" id="friendly_url"
                                                required maxlength="255" minlength="10" readonly>
                                        </div>
                                      
                                        <small id="friendly_url_help" class="form-text text-muted">URL Interna para o endereço normativas</small>
                                        
                                    </div>
                                </div>
                                
                            </div><!-- end row-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="telefone">Telefone</label>
                                        <small class=".text-muted">* (DDD) 0000-0000</b></small>
                                        <input type="text" class="form-control phone" value="{{ $unidade->telefone }}" name="telefone"
                                            required maxlength="100" minlength="12" placeholder="(00) 00000-0000">
                                    </div>
                                </div>
                
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="email">Email*</label>
                                        <small class="text-muted">(Separar emails com <b>;(ponto e virgula))</b></small>
                                        <input type="text" class="form-control" value="{{ $unidade->email }}" name="email"
                                            required maxlength="255" placeholder="Ex.: comedmaceio@maceio.com.br">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="url">Endereço na Web</label>
                                        <small class="text-muted">(Página oficial - opcional)</small>
                                        <div class='input-group'>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-globe">
                                                </span>
                                            </span>
                                            <input type='url' class="form-control" id="url" name="url" value="{{ $unidade->url }}" 
                                                maxlength="255" placeholder="Ex.: http://comedmaceio-comed.blogspot.com/"/>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end row -->
                
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="endereco">Endereço</label>
                                        <small class="text-muted">(opcional)</small>
                                        <input type='text' class="form-control" name="endereco" value="{{ $unidade->endereco }}" maxlength="255"/>
                                    </div>
                                </div>
                            </div><!--end row -->
                
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="endereco">Gestor</label>
                                        <small class="text-muted">(opcional)</small>
                                        <input type='text' class="form-control" id="contato" name="contato" 
                                            value="{{ $unidade->contato }}" maxlength="255"/>
                                    </div>
                                </div>
                
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="endereco">Contato 2</label>
                                        <small class="text-muted">(opcional)</small>
                                        <textarea class="form-control" id="contato2" name="contato2" maxlength="255">{{ $unidade->contato2 }}</textarea>
                                    </div>
                                </div>
                            </div><!--end row -->


                            <button type="submit" class="btn btn-primary btn-lg" value="Atualizar">Salvar</button>
                            <a href="{{route('home')}}" class="btn btn-danger btn-lg" value="Fechar">Fechar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script src="{{ asset('js/app-unidades.js') }}"></script>
@endpush