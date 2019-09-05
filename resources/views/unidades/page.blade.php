@extends('layouts.master')

@section('content')
<!-- mini-header -->
<section id="mini-header">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-lg-2 offset-lg-1">
                <h1>
                <a href="{{route('index')}}">
                    <img class="img-fluid" src="/img/normativos-logo.png" srcset="/img/normativos-logo@2x.png 2x" alt="Normativas" /></h1>
                </a>
            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4 text-right">
                <a class="btn btn-mobile btn-info btn-pill m-1 mt-2 btn-sm" href="{{route('unidades-search')}}" target="_blank"><i class="fa fa-cogs"></i> Pesquisar Conselhos</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-pill btn-login m-1 mt-2">Home <i class="fa fa-user badge-info"></i></a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-pill btn-login m-1 mt-2">Entrar <i class="fa fa-user badge-info"></i></a>
                        <!--
                        <a href="{{ route('register') }}">Registrar</a>
                        -->
                    @endauth
                @endif
            </div>
        </div>
    </div>
</section>
<!-- end mini-header -->
<section id="unidade" class="mt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="box-head">
                    <div class="row">
                        <div class="col-lg-6">
                            <h1>{{$unidade->sigla}}</h1>
                            <h2>{{$unidade->nome}}</h2>
                        </div>
                        <div class="col-lg-6 text-right">
                            @if ($unidade->documentos_count > 0)
                                <p class="n-atos">
                                    <span>1200</span>
                                    <em>atos normativos enviados</em>
                                </p>
                                <br />
                            @endif
                            <a class="btn btn-mobile btn-info btn-pill btn-sm" href="{{$unidade->url}}" target="_blank"><i class="fa fa-external-link"></i> Acesse o site</a>
                            <br />
                            @if (isset($unidade->confirmado_em))
                                <small><b>Data de ingresso:</b> {{date('d/m/Y', strtotime($unidade->confirmado_em))}}</small>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row mt-2 mb-4">
                            <div class="col-lg-12">
                                <form action="{{route('index')}}" method="GET">
                                    <div class="input-group">
                                        <input type="text" name="query" id="query" class="form-control"
                                            placeholder="Busque atos normativos do {{$unidade->sigla}}" value=""/>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-mobile btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
                                            </div>
                                    </div>
                                    <input type="hidden" name="fonte" id="fonte" value="{{$unidade->sigla}}" />
                                </form>
                            </div>
                        </div>

                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#info">Info</a></li>
                            @forelse ($tiposTotal as $i => $tipo)
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#{{$tipo->tipo}}">{{$tipo->tipo}} <span class="badge badge-pill badge-dark">{{$tipo->total}}</span></a></li>
                            @empty
                            @endforelse
                        </ul>

                        <div class="row">
                            <div class="col-lg-12">
                                    <div class="tab-content">
                                        <div id="info" class="tab-pane fade in active show">
                                            <!-- sobre o conselho -->
                                            <div class="row mt-4">
                                                <div class="col-lg-6">
                                                    <div class="card no-border">
                                                        <div class="card-header">
                                                            Sobre o Conselho
                                                        </div>
                                                        <div class="card-body pl-0 pr-0">
                                                            <div class="row pl-3 pr-3">
                                                                <div class="col-lg-4">
                                                                    <i class="fa fa-users"></i> <b><i>Gestão:</i></b>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <span class="form-value">{{$unidade->contato}}</span><br />
                                                                    <span class="form-value">{{$unidade->contato2}}</span>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row pl-3 pr-3">
                                                                <div class="col-lg-4">
                                                                    <i class="fa fa-adjust"></i> <b><i>Esfera:</i></b>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    {{$unidade->esfera}}
                                                                </div>
                                                            </div>
                                                             <hr>
                                                            <div class="row pl-3 pr-3">
                                                                <div class="col-lg-4">
                                                                    <i class="fa fa-globe"></i> <b><i>Município(UF):</i></b>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    {{$unidade->estado['nome'].' ('.$unidade->estado['sigla'].')'}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="card no-border">
                                                        <div class="card-header">
                                                            Contato
                                                        </div>
                                                        <div class="card-body pl-0 pr-0">
                                                            <div class="row pl-3 pr-3">
                                                                <div class="col-lg-4">
                                                                     <i class="fa fa-envelope"></i> <b><i>Email:</i></b>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    {{$unidade->email}}
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row pl-3 pr-3">
                                                                <div class="col-lg-4">
                                                                    <i class="fa fa-phone"></i> <b><i>Telefone:</i></b>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <a href="tel:{{$unidade->telefone}}">{{$unidade->telefone}}</a>
                                                                </div>
                                                            </div>
                                                             <hr>
                                                            <div class="row pl-3 pr-3">
                                                                <div class="col-lg-4">
                                                                    <i class="fa fa-map-marker"></i> <b><i>Endereço:</i></b>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    {{$unidade->endereco}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fim sobre o conselho -->
                                        </div>
                                        @forelse ($tiposTotal as $i => $tipo)
                                            <div id="{{$tipo->tipo}}" class="tab-pane fade in">
                                                <div class="card mt-4">
                                                    <div class="card-body">
                                                        <div class="alert" style="background-color: #357a90; color: #ffffff;">
                                                            @if ($tipo->total > 25)
                                                                Listando apenas 25 atos normativos. <br/>
                                                            @elseif ($tipo->total > 1)
                                                                Listando todos os <strong>{{$tipo->total}}</strong> atos normativos. <br/>
                                                            @else
                                                                Mostrando <strong>1</strong> ato normativo. <br/>
                                                            @endif
                                                            Para ver mais <a class="text-light" href="{{route('index', ['query' => $tipo->tipo,'fonte' => $unidade->sigla])}}">clique aqui</a>
                                                        </div>
                                                        @foreach ($documentos as $k => $docs)
                                                            @if ($k === $tipo->id)
                                                            @foreach ($docs as $doc)
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="card mb-3">
                                                                        <div class="card-header">
                                                                            <strong>{{ $doc->titulo }}</strong>
                                                                        </div>

                                                                        <div class="card-body">
                                                                            @if ( isset($doc->ementa) &&
                                                                                (substr( $doc->ementa , -10) !=  substr($doc->titulo, -10))
                                                                                )
                                                                                <strong>Ementa:&nbsp;&nbsp;</strong>{{ $doc->ementa}}
                                                                                <hr/>
                                                                            @endif
                                                                            @if (!empty($doc->numero))
                                                                            <strong>Número:</strong> {{ $doc->numero}}
                                                                            @endif
                                                                            <br/>
                                                                            @if (!$doc->assunto->isDesconhecido())
                                                                            <strong>Assunto:</strong> {{$doc->assunto->nome}}
                                                                            @endif
                                                                            <br/>
                                                                            <strong>Publicação:</strong> {{ date('d/m/Y', strtotime($doc->data_publicacao )) }}
                                                                            <br />
                                                                            @if(isset($doc->tags))
                                                                                <strong>Palavras-Chave:</strong>
                                                                                @foreach ($doc->tags as $tag)
                                                                                    <a href="?query={{$tag}}" class="badge badge-info">
                                                                                        {{ $tag }}
                                                                                    </a>
                                                                                @endforeach
                                                                            @endif
                                                                            <hr class="split-sm">
                                                                            <a href="{{ route("pdfNormativa",$doc->arquivo) }}" class="btn btn-primary" target="_blank">
                                                                                Fazer Download do Arquivo
                                                                            </a>
                                                                            <br/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @empty

                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="mx-3 pull-left">
                            <a href="javascript:history.back();" class="btn btn-primary"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Voltar</a>
                        </div>

                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-10 -->
        </div>
</section>

<hr class="split">
@endsection
