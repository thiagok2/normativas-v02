@extends('adminlte::page')

@section('title', 'Normativas')


@section('content_header')

@endsection

@section('content')

<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        @include('admin.includes.alerts')

        @if (auth()->user()->isAdmin())
            <div class="alert bg-red fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>
                    <a href="{{route('getenv')}}">Acesse as variáveis de ambiente do sistema.</a>
                </p>
            </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <!-- small box -->
        <!--<a href="{{route('documentos')}}">-->
        <a href="/Manual_Upload.pdf" download target="_blank">
            <div class="small-box bg-light-blue">
                <div class="inner">
                    <h3>Guia</h3>

                    <p>Descubra a plataforma</p>
                </div>
                <div class="icon">

                    <i class="fa fa-book"></i>
                </div>
                <div class="small-box-footer">
                    Acesse o PDF guia da plataforma
                    <i class="fa fa-arrow-circle-right"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3">
        <!-- small box -->
        <a href="{{route('publicar')}}">
            <div class="small-box bg-green">
                <div class="inner">

                    <h3>Novo</h3>

                    <p>Publique um novo documento</p>
                </div>
                <div class="icon">
                    <i class="ion ion-document-text"></i>
                </div>
                <div class="small-box-footer">
                    Enviar um novo documento
                    <i class="fa fa-arrow-circle-up"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- ./col -->

    <div class="col-lg-3">
        <!-- small box -->
        <a href="{{route('documentos')}}">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$documentosCount}} atos</h3>

                    <p>
                        {{$documentosPendentesCount}} com informação pendentes
                    </p>
                </div>
                <div class="icon">

                    <i class="ion ion-search"></i>
                </div>
                <div class="small-box-footer">
                    Veja os documentos do seu conselho
                    <i class="fa fa-arrow-circle-right"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    <div class="col-lg-3">
        <!-- small box -->
        <a href="{{route('usuarios')}}">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$usersCount}}</h3>

                    <p>Colaboradores na sua unidade</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <div class="small-box-footer">
                    Acesse a lista de Colaboradores
                    <i class="fa fa-arrow-circle-right"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- ./col -->
</div><!-- ./row-->

<div class="row">
    <div class="col-lg-12">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Documentos pendentes({{$documentosPendentesExtrator->total()}}) - Edite e resolva as pendências para publicá-los</h3>
            </div>
                <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th style="width: 2%">#</th>
                            <th style="width: 10%">Número</th>
                            <th style="width: 25%">Título</th>
                            <th>Envio</th>
                            <th></th>
                            <th>Fonte</th>
                            <th>Tipo</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documentosPendentesExtrator as $doc)
                            <tr @if ($doc->isBaixado()) class='bg-warning' @else class='bg-danger' @endif>
                                <td>
                                    {{$loop->index+1}}
                                </td>
                                <td>{{$doc->numero}}</td>
                                <td>{{$doc->titulo}}</td>
                                <td>{{date('d-m-Y', strtotime($doc->data_envio))}}</td>
                                <td>
                                    <span class="badge bg-secondary">{{$doc->formato}}</span>
                                    <span class="badge bg-secondary">{{$doc->tipo_entrada}}</span>
                                    <span class="badge bg-secondary">{{$doc->status()}}</span>
                                </td>
                                <td>
                                    {{$doc->unidade->nome}}
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{$doc->tipoDocumento->nome}}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route("documento-edit",$doc->id) }}" title="Editar">
                                        <i class="fa fa-edit fa-3x" ></i>
                                    </a>
                                    @if ($doc->isIndexado())
                                        <a href="/normativa/view/{{ $doc['arquivo'] }}" target="_blank" title="Abrir no portal Normativas">
                                            <i class="fa fa-external-link"></i>
                                        </a>
                                
                                        <a  target="_blank"  href="{{route('pdfNormativa',$doc->arquivo)}}" title="Download">
                                            <i class="fa fa-cloud-download"></i>
                                        </a>
                                    @elseif ($doc->isBaixado())
                                        <a href='{{ Storage::url("uploads/$doc->arquivo")}}' target="_blank" title="Download(local)">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <span class="text-muted">
                    <a href="{{route("documentos-pesquisar-status")}}">Clique aqui acesse a busca por pendências</a>
                </span>
            </div>

        </div>
    </div>
</div><!-- end row docs pendentes-->

<div class="row">
    <div class="col-lg-12">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Documentos recentes(10)</h3>
            </div>
                <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th style="width: 2%">#</th>
                            <th style="width: 10%">Número</th>
                            <th style="width: 25%">Título</th>
                            <th>Envio</th>
                            <th></th>
                            <th>Fonte</th>
                            <th>Tipo</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documentos as $doc)
                            <tr  @if ($doc->completed) class='bg-success' @else class='bg-warning' @endif>
                                <td>
                                    {{$loop->index+1}}
                                </td>
                                <td>{{$doc->numero}}</td>
                                <td>{{$doc->titulo}}</td>
                                <td>{{date('d-m-Y', strtotime($doc->data_envio))}}</td>
                                <td>
                                    <span class="badge bg-secondary">{{$doc->formato}}</span>
                                    <span class="badge bg-secondary">{{$doc->tipo_entrada}}</span>
                                </td>
                                <td>
                                    {{$doc->unidade->nome}}
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{$doc->tipoDocumento->nome}}
                                    </span>
                                </td>
                                <td>
                                    @if ($doc->isIndexado())
                                        <a href="/normativa/view/{{ $doc['arquivo'] }}" target="_blank" title="Abrir no portal Normativas">
                                            <i class="fa fa-external-link"></i>
                                        </a>
                                
                                        <a  target="_blank"  href="{{route('pdfNormativa',$doc->arquivo)}}" title="Download">
                                            <i class="fa fa-cloud-download"></i>
                                        </a>
                                    @elseif ($doc->isBaixado())
                                        <a href='{{ Storage::url("uploads/$doc->arquivo")}}' target="_blank" title="Download(local)">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    @endif

                                    <a href="{{ route("documento",$doc->id) }}" title="Visualizar">
                                        <i class="fa fa-eye fa-2x" ></i>
                                    </a>
                                    <a href="{{ route("documento-edit",$doc->id) }}" title="Editar">
                                        <i class="fa fa-edit fa-2x" ></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <span class="text-muted">
                    Já foram enviados {{$documentos->total()}} documentos no total.
                </span>
            </div>

        </div>
    </div>
</div><!-- end row docs enviados-->
</div>


@endsection

@push('scripts')
    <script src="{{ asset('js/app-home.js') }}"></script>
@endpush
