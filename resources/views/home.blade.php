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
            <div class="alert bg-red alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>
                    <a href="{{route('getenv')}}">Acesse as variáveis de ambiente do sistema.</a>
                </p>
            </div>
        @endif
    </div>    
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="alert alert-success" style="padding: 10px;">
            Você é um usuário acessor. Você pode conceder aos conselhos municipais de educação acesso à plataforma Normativas.
        </p>
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

@if (auth()->user()->isAdmin() || auth()->user()->isAcessor())
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="fa fa-university"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Conselhos Confirmados</span>
            <span class="info-box-number">
                {{$countUnidadesConfirmadas}} ({{$porcentagemConfirmadas}}%)
                de {{$totalUnidades}}
            </span>

            <div class="progress">
            <div class="progress-bar" style="width: {{$porcentagemConfirmadas}}%"></div>
            </div>
                <span class="progress-description">
                {{$countUnidadesConfirmadas30Dias}} nos últimos 30 dias
                </span>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-olive">
        <span class="info-box-icon"><i class="fa fa-bookmark"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Documentos</span>
            <span class="info-box-number">{{$countEnviados30dias}}</span>

            <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
            </div>
                <span class="progress-description">
                Enviados nos últimos 30 dias
                </span>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-teal-active">
        <span class="info-box-icon"><i class="fa fa-users"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Acessos dos gestores</span>
            <span class="info-box-number">
               {{$acessosGestores30Dias}}
               <small></small>
            </span>

            <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
            <span class="progress-description">
                Acessaram nos últimos 30 dias
            </span>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange-active">
        <span class="info-box-icon"><i class="fa fa-search"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Pesquisas ({{$totalConsultas}})</span>
            <span class="info-box-number">
                {{$totalConsultas3060[0]->total}} <small>nos últimos 30 dias</small>
            </span>

            <div class="progress">
            <div class="progress-bar" style="width: {{$percentConsultas}}%"></div>
            </div>
                <span class="progress-description">
                    Mês anterior {{$totalConsultas3060[1]->total}}
                </span>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
@endif
<!-- /.row -->
@if ( auth()->user()->isAdmin() )
<div class="row">
    <div class="col-lg-5">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Conselhos confirmados </h3>
            </div>
            <div class="box-body no-padding">
                <canvas id="chartConsConfirmados"></canvas>
            </div>
            <div class="box-footer">
                <span class="text-muted pull-right">
                    <a href="{{route('unidades')}}">
                        Consulte os conselhos
                    </a>
                </span>
            </div>
        </div><!-- end box-->
    </div><!-- end col-6 -->

    <div class="col-lg-2">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Tipos</h3>
            </div>
            <div class="box-body">
                @foreach ($documentosPorTipo as $v)
                    <div class="clearfix">
                    <span class="pull-left">{{$v->nome}} ({{$v->total}})</span>
                        <small class="pull-right">{{$v->percent}}%</small>
                    </div>
                    <div class="progress xs" style="margin-bottom: 8px;">
                        <div class="progress-bar progress-bar-blue" style="width: {{$v->percent}}%;"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Uploads dos últimos meses</h3>
            </div>
            <div class="box-body no-padding">
                <canvas id="chartUploadsMeses"></canvas>
            </div>
            <div class="box-footer">
                <span class="text-muted pull-right">
                    <a href="{{route('documentos')}}">
                        Acesse os últimos uploads
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Últimos 10 documentos</h3>
            </div>
                <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th style="width: 2%">#</th>
                            <th style="width: 8%">Número</th>
                            <th style="width: 25%">Título</th>
                            <th style="width: 10%">Envio</th>
                            <th style="width: 10%"></th>
                            <th>Fonte</th>
                            <th></th>
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
                                        {{$doc->tipo_entrada}}
                                    </span>
                                    <span class="badge bg-info">
                                        {{$doc->status_extrator}}
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
</div>
@if (auth()->user()->isAdmin() || auth()->user()->isAcessor())
<div class="row">
    <div class="col-lg-6 ">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Conselhos sem confirmação({{$unidadesNaoConfirmadas->total()}})</h3>
            </div>

            <div class="box-body no-padding">
                <table class="table table-hover table-condensed">
                    <tbody>
                        @forelse ($unidadesNaoConfirmadas as $key=>$unidade)
                            <tr class='bg-warning'>
                                <td>{{ ($unidades->currentpage()-1) * $unidades->perpage() + $key + 1 }}</td>
                                <td>
                                    <a href="{{route("unidade-edit",$unidade->id)}}">
                                        {{ $unidade->nome }}
                                    </a>
                                </td>
                                <td><small> Criado em {{date('d-m-Y', strtotime($unidade->created_at))}}</small></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    Sem resultados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <span class="text-muted pull-right">
                    <a href="{{route('unidades')}}">
                        Pesquisar conselhos
                    </a>
                </span>
            </div>
        </div> <!-- end box -->
    </div> <!-- end col-6 -->
    <div class="col-lg-6 ">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Conselhos com mais documentos</h3>
            </div>

            <div class="box-body no-padding">
                <table class="table table-striped table-hover table-condensed">
                    <tbody>
                        @forelse ($unidades as $key=>$unidade)
                            <tr >
                                <td>{{ ($unidades->currentpage()-1) * $unidades->perpage() + $key + 1 }}</td>
                                <td>
                                    <a href="{{route("unidade-edit",$unidade->id)}}">
                                        {{ $unidade->nome }}
                                    </a>
                                </td>
                                <td style="text-align:right;">
                                    {{ $unidade->documentos_count }}
                                    <i class="fa fa-file {{$unidade->documentos_count > 0 ? 'icon-success':'icon-danger'}}"></i>
                                    <i class="glyphicon glyphicon-user {{$unidade->responsavel->confirmado ? 'icon-success':'icon-danger'}}"></i>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    Sem resultados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <span class="text-muted pull-left">

                    Total de {{$unidades->total()}} conselhos

                </span>
            </div>
        </div> <!-- end box -->
    </div> <!-- end col-6 -->
</div> <!-- end row-->
@endif

@if (auth()->user()->isAdmin())
<div class="row">
    <div class="col-lg-6">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Palavras-chave mais referências nos documentos</h3>
            </div>

            <div class="box-body no-padding">
                <div id="myCanvasContainer" class="text-center" style="position:relative;">
                    <canvas width="600" height="300"  id="myCanvas">
                        <ul>
                            @foreach ($tags as $t)
                                <li><a href=/?query={{$t->tag}}" target="_blank" data-weight="{{$t->tag_count}}">{{$t->tag}}</a></li>
                            @endforeach
                        </ul>
                    </canvas>
                </div>
            </div>
            <div class="box-footer">

            </div>
        </div> <!-- end box -->
    </div>

    <div class="col-lg-6">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Termos mais pesquisados</h3>
            </div>

            <div class="box-body no-padding">
                <div id="myCanvasContainer2" class="text-center" style="position:relative;">
                    <canvas width="600" height="300"  id="myCanvas2">
                        <ul>
                            @foreach ($topConsultas as $t)
                                <li><a href=/?query={{$t->termos}}" target="_blank" data-weight="{{$t->total}}">{{$t->termos}}</a></li>
                            @endforeach
                        </ul>
                    </canvas>
                </div>
            </div>
            <div class="box-footer">

            </div>
        </div> <!-- end box -->
    </div>
</div>
@endif
</div>


@endsection

@push('scripts')
    <script src="{{ asset('js/app-home.js') }}"></script>
@endpush
