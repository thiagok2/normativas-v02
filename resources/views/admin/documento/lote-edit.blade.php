@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
   
@stop

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{route('home')}}">Painel</a></li>
        <li> <a href="#" ><a href="#">Documentos</a></li>
        <li> <a href="#" class="active"><a href="#">Publicar em Lote</a></li>
    </ol>


    <div class="container-fluid">
        @include('admin.includes.alerts')
        <div class="row">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Últimos documentos enviados</h3>
                </div> <!-- /.box-header -->
                   
                <div class="box-body no-padding">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%">Ano</th>
                                <th>Publicação</th>
                                <th style="width: 10%">Número</th>
                                <th style="width: 15%">Tipo</th>
                                <th style="width: 15%">Assunto</th>
                                <th style="width: 30%">Título</th>
                                <th style="width: 25%">Ementa</th>
                                
                               
                                <th style="width: 2%"></th>
                            </tr>
                        </thead>  
                        <tbody>
                            @forelse ($documentos as $key=>$doc)
                            <tr>
                                
                                <td>
                                    <input type="text" class="form-control"  name="ano_{{$doc->id}}" id="ano_{{$doc->id}}" value="{{$doc->ano}}"/>
                                </td>
                                <td>
                                    
                                    <input type='date' class="form-control" id="data_publicacao_{{$doc->id}}" name="data_publicacao_{{$doc->id}}"/>
                                    
                                </td>
                                <td>
                                    <input type="text" class="form-control"  name="ano_{{$doc->id}}" id="ano_{{$doc->id}}" value="{{$doc->numero}}"/>
                                </td>
                                <td>
                                    <select class="form-control" required id="tipo_documento_id_{{$doc->id}}" name="tipo_documento_id_{{$doc->id}}">
                                        @foreach ($tiposDocumento as $tipo)
                                            <option value="{{$tipo->id}}" {{($doc->tipoDocumento->id == $tipo->id ? 'selected="selected"':'')}}>{{$tipo->nome}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" required id="assunto_id_{{$doc->id}}" name="assunto_id_{{$doc->id}}">
                                        @foreach ($assuntos as $ass)
                                            <option value="{{$ass->id}}" {{($doc->assunto->id == $ass->id ? 'selected="selected"':'')}}>{{$ass->nome}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control"  name="titulo_{{$doc->id}}" id="titulo_{{$doc->id}}" value="{{$doc->titulo}}"/>
                                </td>
                                <td>
                                    <textarea rows="4" cols="50" name="ementa_{{$doc->id}}" id="ementa_{{$doc->id}}"></textarea>
                                </td>
                                
                                <td>
                                    <a href="{{ route("pdfNormativa",$doc->arquivo) }}" target="_blank">
                                        <i class="fa fa-arrow-circle-down"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9">
                                    <span class="no-results">Sem documentos enviados</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                   
                </div><!--end body -->
            </div><!--end box -->
            <input type="button" class="btn btn-primary btn-lg" value="Concluir">
        </div><!-- end row -->
        
    </div><!-- end container -->
   
@endsection
@push('scripts')
    <script src="{{ asset('js/app-lote.js') }}"></script>
@endpush