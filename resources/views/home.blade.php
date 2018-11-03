@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
    
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
        <div class="inner">
            <h3>{{$documentosCount}}</h3>

            <p>Documentos</p>
        </div>
        <div class="icon">
            <i class="ion ion-document-text"></i>
        </div>
            <a href="{{route('publicar')}}" class="small-box-footer">
                Publicar novo Documento
                <i class="fa fa-arrow-circle-up"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
        <div class="inner">
            <h3>{{$tagCount}}</h3>

            <p>Palavras Chaves</p>
        </div>
        <div class="icon">
            <i class="ion ion-grid"></i>
        </div>
        <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
        <div class="inner">
            <h3>{{$usersCount}}</h3>

            <p>Colaboradores</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
        <div class="inner">
            <h3>?</h3>

            <p>Consultas realizadas</p>
        </div>
        <div class="icon">
            <i class="ion ion-search"></i>
        </div>
        <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
    <div class="col-lg-9 col-xs-12">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Documentos recentes</h3>
            </div>
                <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed table-hover">
                    <tbody>
                        <tr>
                            <th style="width: 2%">#</th>
                            <th style="width: 10%">Número</th>
                            <th style="width: 35%">Título</th>
                            <th>Palavras-chave</th>
                            <th>Fonte</th>
                            <th>Tipo</th>
                            <th>#</th>
                        </tr>
                        @foreach ($documentos as $doc)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$doc->numero}}</td>
                                <td>{{$doc->titulo}}</td>
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
                                    <a  href="https://normativas-dev.herokuapp.com/normativa/pdf/{{$doc->numero}}">
                                        <i class="fa fa-arrow-circle-down"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        
                        
                    </tbody>
                </table>
            </div>
                <!-- /.box-body -->
        </div>
    </div>
    <div class="col-lg-3 col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Termos mais pesquisados</h3>
            </div>

            <div class="box-body no-padding">
                <table class="table table-condensed table-hover">
                    <tbody>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 70%">Termos</th>
                            <th style="width: 25%"></th>
                        </tr>
                        <tr>
                            <td>1.</td>
                            <td>Reforma</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-success" style="width: 35%"></div>
                                </div>        
                            </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Educação a distância</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-success" style="width: 20%"></div>
                                </div>
                            </td>
                        </tr>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Educação a Inclusiva</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-success" style="width: 15%"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Ensino Religioso</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-success" style="width: 8%"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>Progressão</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-success" style="width: 6%"></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Palavras chaves mais referências nos documentos</h3>
            </div>

            <div class="box-body no-padding">
                <div id="myCanvasContainer">
                    <canvas width="400px" height="250px" id="myCanvas">
                        <ul>
                            @foreach ($tags as $t)
                                <li><a href="https://normativas-dev.herokuapp.com/?query={{$t->tag}}" target="_blank" data-weight="{{$t->tag_count}}">{{$t->tag}}</a></li>
                            @endforeach
                        </ul>
                    </canvas>
                </div>
            </div>
            <div class="box-footer">
                
            </div>
        </div> <!-- end box -->
    </div> <!-- end col-6 -->


    <div class="col-lg-6">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Termos mais pesquisadas</h3>
            </div>

            <div class="box-body no-padding">
                <div id="myCanvasContainer2">
                    <canvas width="400px" height="250px" id="myCanvas2">
                        <ul>
                            @foreach ($termosPesquisados as $t)
                                <li><a href="https://normativas-dev.herokuapp.com/?query={{$t->tag}}" target="_blank" data-weight="{{$t->tag_count}}">{{$t->tag}}</a></li>
                            @endforeach
                        </ul>
                    </canvas>
                </div>
            </div>
            <div class="box-footer">
                
            </div>
        </div> <!-- end box -->
    </div> <!-- end col-4 -->

    <!--
    <div class="col-lg-4">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Normativas - Conselhos estaduais</h3>
            </div>

            <div class="box-body">
                <div id="uf-chart" style="height: 300px;"></div>
            </div>

        </div>
    </div>
    -->
</div> <!-- end row-->



@stop
