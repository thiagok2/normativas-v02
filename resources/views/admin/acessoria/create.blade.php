@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">Painel</a></li>
            <li> <a href="{{route('unidades')}}" >Acessoria</a></li>
            <li> <a href="#" ><a href="#">Nova Unidade</a></li>
        </ol>

       

        <div class="row">
            <div class="col-lg-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Nova Unidade de Acessoria
                    </div>
                    <div class="panel-body">
                    <form name="form" id="form" method="post" action="{{route('unidade-save')}}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="tipo" id="tipo" value="Acessoria"/>
                            <div class="row">
                            
                                <div class="col-md-12">
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
                    
                            </div><!-- end estados/municipios-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="nome">Nome*</label>
                                        <input type="text" class="form-control" value="{{ $unidade->nome }}" name="nome" id="nome"
                                            required maxlength="255" minlength="10" placeholder="Ex.: Acessoria de Educação de Alagoas">
                                    </div>
                                </div>

                                                                                                     
                            </div><!-- end row-->
                
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="endereco">Gestor</label>
                                        <small class="text-muted"></small>
                                        <input type='text' class="form-control" id="contato" name="contato" 
                                            value="{{ $unidade->contato }}" maxlength="255"/>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="email">Email*</label>
                                        <small class="text-muted"></small>
                                        <input type="text" class="form-control" value="{{ $unidade->email }}" name="email"
                                            required maxlength="255" placeholder="Ex.: acessor@educacaoalagoas.com.br">
                                    </div>
                                </div>
                            </div><!--end row -->

                            <button type="submit" class="btn btn-success" value="Criar unidade">Criar unidade</button>
                            <a href="{{route('home')}}" class="btn btn-danger" value="Fechar">Fechar</a>
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