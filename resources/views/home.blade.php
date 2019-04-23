@extends('adminlte::page')

@section('title', 'Normativas')


@section('content_header')

@endsection

@section('content')

<div class="container-fluid">
<div class="row">
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

@if (auth()->user()->isAdmin())
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
@if (auth()->user()->isAdmin())
<div class="row">
    <div class="col-lg-4">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Conselhos confirmados </h3>
            </div>
            <div class="box-body no-padding">
                <canvas id="chartConsConfirmados"></canvas>
                <!--<table class="table table-condensed table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Mês</th>
                            <th>Criados</th>
                            <th>Confirmados</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evolucaoUnidadesConfirmadasMes as $e)
                            <tr>
                                <td>{{$e->mes_ano_abrev}}</td>
                                <td>{{$e->criados}}</td>
                                <td>{{$e->confirmados}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>-->
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
                <h3 class="box-title">Assuntos</h3>
            </div>
            <div class="box-body">
                <!--<canvas id="chartAssuntos"></canvas>
                <br />
                <br />-->
                @foreach ($documentosPorAssunto as $v)
                    <div class="clearfix">
                    <span class="pull-left">{{$v->nome}} ({{$v->total}})</span>
                        <small class="pull-right">{{$v->percent}}%</small>
                    </div>
                    <div class="progress xs" style="margin-bottom: 8px;">
                        <div class="progress-bar progress-bar-green" style="width: {{$v->percent}}%;"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-lg-2">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Tipos</h3>
            </div>
            <div class="box-body">
                <!--<canvas id="chartTipos"></canvas>
                <br />
                <br />-->
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

    <div class="col-lg-4">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Uploads dos últimos meses</h3>
            </div>
            <div class="box-body no-padding">
                <canvas id="chartUploadsMeses"></canvas>
                <!--<table class="table table-condensed table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Mês</th>
                            <th>Enviados</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evolucaoEnviados6Meses as $e)
                            <tr>
                                <td>{{$e->mes_ano_abrev}}</td>
                                <td>{{$e->enviados}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>-->
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
                <h3 class="box-title">Documentos recentes(10)</h3>
            </div>
                <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th style="width: 2%">#</th>
                            <th style="width: 10%">Número</th>
                            <th style="width: 35%">Título</th>
                            <th>Envio</th>
                            <th>Palavras-chave</th>
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
                                    @foreach ($doc->palavrasChaves as $p)
                                        <span class="badge bg-secondary">{{$p->tag}}</span>
                                    @endforeach
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
                                    <a  target="_blank"  href="{{route('pdfNormativa',$doc->arquivo)}}">
                                        <i class="fa fa-arrow-circle-down"></i>
                                    </a>
                                    <a href="{{ route("documento",$doc->id) }}">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <span class="text-muted">
                    Já foram enviados {{$documentos->count()}} documentos no total.
                </span>
            </div>

        </div>
    </div>
</div>
@if (auth()->user()->isAdmin())
<div class="row">
    <div class="col-lg-6 ">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Conselhos sem confirmação({{$unidadesNaoConfirmadas->total()}})</h3>
            </div>

            <div class="box-body no-padding">
                <table class="table table-striped table-hover table-condensed">
                    <tbody>
                        @forelse ($unidadesNaoConfirmadas as $key=>$unidade)
                            <tr>
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
                            <tr>
                                <td>{{ ($unidades->currentpage()-1) * $unidades->perpage() + $key + 1 }}</td>
                                <td>
                                    <a href="{{route("unidade-edit",$unidade->id)}}">
                                        {{ $unidade->nome }}
                                    </a>
                                </td>
                                <td>
                                    {{ $unidade->documentos->count() }}
                                    <i class="fa fa-file {{$unidade->documentos->count()>0 ? 'icon-success':'icon-danger'}}"></i>
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

                    Até momento, {{$unidades->total()}} conselhos enviaram documentos.

                </span>
            </div>
        </div> <!-- end box -->
    </div> <!-- end col-6 -->
</div> <!-- end row-->
@endif
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
</div>


@endsection

@push('scripts')
    <script src="{{ asset('js/app-home.js') }}"></script>
<script>

        /*var ctxUploadsMeses = document.getElementById('chartUploadsMeses')
        var labels = [];
        var enviados = [];

        @foreach ($evolucaoEnviados6Meses as $e)
            labels.push('{!!$e->mes_ano_abrev!!}');
            enviados.push('{!!$e->enviados!!}');
        @endforeach

        var chartUploadsMeses = new Chart(ctxUploadsMeses, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Enviados',
                        data: enviados,
                        backgroundColor: 'rgba(36, 123, 160, 0.2)',
                        borderColor: 'rgba(36, 123, 160, 1)'
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });*/


</script>
@endpush
