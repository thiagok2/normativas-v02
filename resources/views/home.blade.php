@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

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

    <div class="col-lg-4">
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

    <div class="col-lg-4">
        <!-- small box -->
        <a href="{{route('documentos')}}">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$documentosCount}}</h3>

                    <p>Documentos enviados</p>
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
    <div class="col-lg-4">
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
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Documentos recentes(10)</h3>
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
            </div>
                <!-- /.box-body -->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 ">
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
    </div> <!-- end col-6 -->
    <div class="col-lg-6 ">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Unidades com mais documentos</h3>
            </div>

            <div class="box-body no-padding">
                <table class="table table-striped table-hover table-condensed">
                    <tbody>
                        @forelse ($unidades as $key=>$unidade)
                            <tr>
                                <td>{{ ($unidades->currentpage()-1) * $unidades->perpage() + $key + 1 }}</td>
                                <td>{{ $unidade->nome }}</td>
                                <td>
                                    {{ $unidade->documentos->count() }}
                                    <i class="glyphicon glyphicon-file {{$unidade->documentos->count()>0 ? 'alert-success':'alert-danger'}}"></i>
                                    <i class="glyphicon glyphicon-user {{$unidade->responsavel->confirmado ? 'alert-success':'alert-danger'}}"></i>
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
        </div> <!-- end box -->
    </div> <!-- end col-6 -->
</div> <!-- end row-->
</div>



@stop
