@extends('layouts.master')

@section('content')
<!-- header -->
<section id="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-right p-0 ">
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
        <div class="row">
            <div class="col-lg-12 text-center">
                <hr class="split">
                <h1><img src="/img/normativos-logo.png" srcset="/img/normativos-logo@2x.png 2x" alt="Normativas" /></h1>
                <hr class="split">
            </div>
        </div>
    </div>
</section>
<!-- end header -->

<!-- search form -->
<section id="search">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                @if (isset($erro))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{$erro['titulo']}}</strong>
                        <br/>
                        Notifique a administração do sistema através do email:
                        <a href="mailto:normativas@nees.com.br?Subject=Notificação de erro" target="_top">normativas@nees.com.br</a>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @if(getenv('APP_DEBUG'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <b>DEBUG</b>

                            <small>
                                <p>{{$erro['local']}}</p>

                                <p>{{$erro['trace']}}</p>
                            </small>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                @endif

                <form action="/" method="GET" class="">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control" placeholder="Digite os termos da consulta" value="{{ $query }}" />
                    </div>
                    <div class="row">
                        <div class="col text-center mt-3 mb-3">
                            <button type="submit" class="btn btn-mobile btn-primary mr-1"><i class="fa fa-search"></i> Pesquisar normativas</button>
                            <button type="button" class="btn btn-mobile btn-info ml-1" data-toggle="collapse" data-target="#filters-menu" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-cogs"></i> Configurações da busca</button>
                            <a class="btn btn-mobile btn-info ml-1" href="{{route('unidades-search')}}" target="_blank">
                                <i class="fa fa-cogs"></i> Pesquisar Conselhos
                            </a>
                        </div>
                    </div>
                    <div id="filters-menu" class="collapse <?php if($filters){ echo 'show'; }?>">
                        <div class="row">
                            <!--
                            <div class="col col-12 col-lg-4 mb-1">
                                <select class="form-control" name="tipo_doc">
                                    <option value="all" <?php if($tipo_doc == "all"){ echo ' selected'; }?>>Todos os Tipos</option>

                                    {{-- @foreach ($tiposDocumento as $tipo)
                                        <option value="{{$tipo->nome}}"
                                            @if ($tipo_doc == $tipo->nome) selected @endif>Apenas {{$tipo->nome}}</option>
                                    @endforeach
                                    --}}

                                </select>
                            </div>
                            -->
                            <div class="col col-12 col-lg-4 offset-lg-2 mb-1">
                                <select class="form-control" name="esfera" >
                                    <option value="all" <?php if($esfera == "all"){ echo ' selected'; }?>>Todas as Esfera</option>
                                    <option value="Federal" <?php if($esfera == "Federal"){ echo ' selected'; }?>>Federal</option>
                                    <option value="Estadual" <?php if($esfera == "Estadual"){ echo ' selected'; }?>>Estadual</option>
                                    <option value="Municipal" <?php if($esfera == "Municipal"){ echo ' selected'; }?>>Municipal</option>
                                </select>
                            </div>
                            <div class="col col-12 col-lg-4 mb-1">
                                <select class="form-control" name="periodo">
                                    <option value="all">Todos os Tempos</option>
                                    <option value="<?php echo date("Y"); ?>" <?php if($periodo == date("Y")){ echo ' selected'; }?>>Deste Ano</option>
                                    <option value="<?php echo (date("Y")-2); ?>" <?php if($periodo == date("Y")-2){ echo ' selected'; }?>>Últimos 2 anos</option>
                                    <option value="<?php echo (date("Y")-5); ?>" <?php if($periodo == date("Y")-5){ echo ' selected'; }?>>Últimos 5 anos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- end search form -->

<!-- results -->
<section id="results">
    <div class="container-fluid">
        @if (!empty($documentos))
            <!--<div class="row" id="results-text">
                <div class="col-lg-10 offset-lg-1">
                <p class="mb-3 mt-3">
                    <em>{{ $total }}</em> resultados encontrados. Exibindo de <em>{{($page-1) * $size_page}} até {{($page) * $size_page}}</em>
                    <br/>
                    <!--Score máximo ({{ $max_score }}).
                </p>
                </div>
            </div>-->
            <!-- aggregates -->
            @if (!empty($query) && (!empty($documentos)))
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <p class="mb-3 mt-3">
                            <i class="fa fa-filter"></i> <strong> Filtrar resultados</strong> <em>({{ $total }}</em> resultados encontrados. Exibindo de <em>{{(($page-1) * $size_page) +1}} até {{($page) * $size_page}})</em>
                            <br/>
                            <!--Score máximo ({{ $max_score }}).-->
                        </p>
                        <div class="mt-2">
                            @if ((($esfera && $esfera!="all") || $ano || $fonte))
                                <a href="?query={{ $query }}"
                                    class="btn btn-outline-secondary btn-pill btn-sm mb-2">
                                    Limpar Filtros
                                    <span class="badge badge-pill badge-info"></span>
                                </a>
                            @endif

                            @if (isset($aggregations))
                                @foreach ($aggregations['ano']['labels'] as $bucket)
                                    <a href="?query={{ $query }}&ano={{ urlencode($bucket['nome']) }}&esfera={{ $esfera  }}&fonte={{ $fonte  }}"
                                        class="btn btn-outline-secondary btn-pill btn-sm mb-2">
                                        {{ ucfirst($bucket['nome']) }}
                                        <span class="badge badge-pill badge-info">{{ $bucket['quantidade'] }}</span>
                                    </a>
                                @endforeach

                                @foreach ($aggregations['esfera']['labels'] as $bucket)
                                    <a href="?query={{ $query }}&esfera={{ urlencode($bucket['nome']) }}&ano={{ $ano }}&fonte={{ $fonte  }}"
                                    class="btn btn-outline-secondary btn-pill btn-sm mb-2">
                                        {{ ucfirst($bucket['nome']) }}
                                        <span class="badge badge-pill badge-info">{{ $bucket['quantidade'] }}</span>
                                    </a>
                                @endforeach

                                @foreach ($aggregations['fonte']['labels'] as $bucket)
                                    <a href="?query={{ $query }}&fonte={{ urlencode($bucket['nome']) }}&ano={{ $ano  }}&esfera={{ $esfera }}"
                                    class="btn btn-outline-secondary btn-pill btn-sm mb-2">
                                        {{ ucfirst($bucket['nome']) }}
                                        <span class="badge badge-pill badge-info">{{ $bucket['quantidade'] }}</span>
                                    </a>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
                <hr class="split-sm">
            @endif
            <!-- fim aggregates -->

            @foreach ($documentos as $doc)
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="card mb-3">
                            <div class="card-header">
                                <a href="/normativa/view/{{ $doc['id'] }}?query={{$query}}">
                                    <i class="fa fa-external-link"></i>  {{ $doc['titulo'] }}
                                </a>

                                
                                <div id="max_score" class="float-lg-right float-xs-left">
                                    <input value="{{ ($doc['score'])  }}" type="text" class="kv-fa rating-loading"
                                        data-min=0
                                        data-max={{$max_score}}
                                        data-step=0.01
                                        data-size="xs"
                                        required title="">
                                </div>
                            </div>

                            <div class="card-body">
                                <strong>Ementa:&nbsp;&nbsp;</strong>{{ $doc['ementa'] }}

                                <hr/>
                                @if (!empty($doc['numero']))
                                <strong>Número:</strong> {{ $doc['numero']}}
                                @endif
                                @if (!empty($doc['tipo_doc']))
                                <strong>Tipo:</strong> {{ $doc['tipo_doc']}}
                                @endif
                                <br/>
                                <strong>Conselho:</strong>
                                    @if (isset($doc['fonte']['sigla']))
                                    <a href="?query={{$query}}&fonte={{ $doc['fonte']['sigla'] }}">
                                        {{ $doc['fonte']['orgao'] }}
                                    </a>
                                    @else
                                        {{ $doc['fonte']['orgao'] }}
                                    @endif


                                <br/>
                                <strong>Publicação:</strong> {{ date('d/m/Y', strtotime($doc['data_publicacao'] )) }}
                                <br />
                                <strong>Palavras-Chave:</strong>
                                @foreach ($doc['tags'] as $tag)
                                    <a href="?query={{$tag}}" class="badge badge-info">
                                        {{ $tag }}
                                    </a>
                                @endforeach
                                <hr class="split-sm">
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#trechos-{{$loop->index}}" aria-expanded="false" aria-controls="highlight-collapse-{{$doc['id']}}"
                                    {{empty($doc['trechos_destaque']) ? 'disabled':''}}>
                                    Trechos encontrados
                                </button>

                                <a href="/normativa/pdf/{{ $doc['id'] }}" class="btn btn-primary" target="_blank">
                                    Baixar
                                </a>

                                @if (Route::has('login') && isset($doc['id_persisted']))
                                    @auth
                                        <a href="{{ route("documento-edit", $doc['id_persisted']) }}" title="Editar" class="btn btn-primary pull-right">
                                            <i class="fa fa-edit" ></i>
                                        </a>
                                    @endauth
                                @endif
                                <br/>

                                <div id="trechos-{{$loop->index}}" class="collapse">
                                @if (!empty($doc['trechos_destaque']))
                                    <small>
                                    <ul class="list-group">
                                        @foreach ($doc['trechos_destaque'] as $highlight)
                                        <li class="list-group-item">
                                            <?php echo html_entity_decode ($highlight); ?>
                                        </li>
                                        @endforeach
                                    </ul>
                                    </small>
                                @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- end results-->


            <!-- pagination-->
            <!-- param page_size(default=10)-->
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <nav>
                        <ul class="pagination justify-content-end">
                            @if ($page > 1)
                            <li class="page-item">
                                <a href="?query={{ urlencode($query) }}&page={{ ($page - 1) }}&esfera={{ $esfera }}&fonte={{ $fonte }}&ano={{$ano}}&periodo={{$periodo}}"
                                    class="page-link" tabindex="-1">Anterior</a>
                            </li>
                            @endif

                            @if($total_pages > 0 && $page <= $total_pages)

                                @php($limit = 3)

                                @for ($i = $page; $i <= min($page + $limit, $total_pages); $i++)
                                     <li class="page-item"><a class="page-link {{$i == $page ? 'active' :'' }}" href="?query={{ urlencode($query) }}&page={{ ($i) }}&esfera={{ $esfera }}&fonte={{ $fonte }}&ano={{$ano}}&periodo={{$periodo}}">{{$i}}</a></li>

                                @endfor

                            @endif



                            @if ($page < $total_pages)
                                <li class="page-item">
                                <a href="?query={{ urlencode($query) }}&page={{ ($page + 1) }}&esfera={{ $esfera }}&fonte={{ $fonte }}&ano={{$ano}}&periodo={{$periodo}}"
                                    class="page-link">Próximo</a>
                                </li>
                            @endif

                            @if ($total_pages > 1)
                                <li class="page-item">
                                <a href="?query={{ urlencode($query) }}&page={{ ($total_pages) }}&esfera={{ $esfera }}&fonte={{ $fonte }}&ano={{$ano}}&periodo={{$periodo}}"
                                    class="page-link">Última</a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- end pagination-->

        @elseif($query)
            <div class="row mt-3" id="no-results">
                <div class="col-lg-6 offset-md-3">
                    <div class="alert alert-secondary" role="alert">
                        Nenhum resultado encontrado.
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
<!-- results -->
<hr class="split">
@endsection

