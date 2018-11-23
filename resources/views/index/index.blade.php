@extends('layouts.master')

@section('content')
<!-- header -->
<section id="header">
    <div class="container-fluid">
        <div class="row">
            @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ route('home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Entrar</a>
                    <!-- 
                    <a href="{{ route('register') }}">Registrar</a>
                    -->
                @endauth
            </div>
            @endif
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
                <form action="/" method="GET" class="">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control" placeholder="Digite os termos da consulta" value="{{ $query }}" />
                    </div>
                    <div class="row">
                        <div class="col text-center mt-3 mb-3">
                            <button type="submit" class="btn btn-primary mr-1"><i class="fa fa-search"></i> Pesquisar normativas</button>
                            <button type="button" class="btn btn-info ml-1" data-toggle="collapse" data-target="#filters-menu" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-cogs"></i> Configurações da busca</button>
                        </div>
                    </div>
                    <div id="filters-menu" class="collapse <?php if($filters){ echo 'show'; }?>">
                        <div class="row">
                            <div class="col">
                                <select class="form-control" name="tipo_doc">
                                    <option value="all" <?php if($tipo_doc == "all"){ echo ' selected'; }?>>Todos os Tipos</option>
                                    <option value="resolução" <?php if($tipo_doc == "resolução"){ echo ' selected'; }?>>Apenas Resoluções</option>
                                    <option value="deliberação" <?php if($tipo_doc == "deliberação"){ echo ' selected'; }?>>Apenas Deliberações</option>
                                    <option value="parecer" <?php if($tipo_doc == "parecer"){ echo ' selected'; }?>>Apenas Pareceres</option>
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-control" name="esfera" >
                                    <option value="all" <?php if($esfera == "all"){ echo ' selected'; }?>>Todas as Esfera</option>
                                    <option value="Federal" <?php if($esfera == "Federal"){ echo ' selected'; }?>>Federal</option>
                                    <option value="Estadual" <?php if($esfera == "Estadual"){ echo ' selected'; }?>>Estadual</option>
                                    <option value="Municipal" <?php if($esfera == "Municipal"){ echo ' selected'; }?>>Municipal</option>
                                </select>
                            </div>
                            <div class="col">
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
        @if (!empty($hits))
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
            @if (!empty($query) && (!empty($hits)))
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <p class="mb-3 mt-3">
                            <i class="fa fa-filter"></i> <strong> Filtrar resultados</strong> <em>({{ $total }}</em> resultados encontrados. Exibindo de <em>{{($page-1) * $size_page}} até {{($page) * $size_page}})</em>
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
                            
                            @foreach ($aggregations['aggregations']['ano']['buckets'] as $bucket)
                                <a href="?query={{ $query }}&ano={{ urlencode($bucket['key']) }}&esfera={{ $esfera  }}&fonte={{ $fonte  }}" 
                                    class="btn btn-outline-secondary btn-pill btn-sm mb-2">
                                    {{ ucfirst($bucket['key']) }} 
                                    <span class="badge badge-pill badge-info">{{ $bucket['doc_count'] }}</span>
                                </a>
                            @endforeach
                        
                            @foreach ($aggregations['aggregations']['esfera']['buckets'] as $bucket)
                                <a href="?query={{ $query }}&esfera={{ urlencode($bucket['key']) }}&ano={{ $ano }}&fonte={{ $fonte  }}" 
                                class="btn btn-outline-secondary btn-pill btn-sm mb-2">
                                    {{ ucfirst($bucket['key']) }} 
                                    <span class="badge badge-pill badge-info">{{ $bucket['doc_count'] }}</span>
                                </a>
                            @endforeach
                        
                            @foreach ($aggregations['aggregations']['fonte']['buckets'] as $bucket)
                                <a href="?query={{ $query }}&fonte={{ urlencode($bucket['key']) }}&ano={{ $ano  }}&esfera={{ $esfera }}" 
                                class="btn btn-outline-secondary btn-pill btn-sm mb-2">
                                    {{ ucfirst($bucket['key']) }} 
                                    <span class="badge badge-pill badge-info">{{ $bucket['doc_count'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr class="split-sm">
            @endif
            <!-- fim aggregates -->

            @foreach ($hits as $hit)
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="card mb-3">
                            <div class="card-header">
                                <a href="/normativa/view/{{ $hit['_id'] }}?query={{$query}}">
                                    <i class="fa fa-external-link"></i>  {{ $hit['_source']['ato']['titulo'] }}
                                </a>

                                <div id="max_score" class="float-lg-right float-xs-left">
                                    <input value="{{ ($hit['_score'])  }}" type="text" class="kv-fa rating-loading" 
                                        data-min=0 
                                        data-max={{$max_score}}
                                        data-step=0.01 
                                        data-size="xs"
                                        required title="">
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <strong>Ementa:&nbsp;&nbsp;</strong>{{ $hit['_source']['ato']['ementa'] }}

                                <hr/>
                                @if (!empty($hit['_source']['ato']['tipo_doc']))
                                <strong>Tipo:</strong> {{ $hit['_source']['ato']['tipo_doc'] }}
                                @endif
                                <br/>
                                <strong>Conselho:</strong> 
                                    <a href="?query={{ $hit['_source']['ato']['fonte']['uf'] }}">
                                        {{ $hit['_source']['ato']['fonte']['orgao'] }}
                                    </a>
                                <br/>
                                <strong>Publicação:</strong> {{ date('d/m/Y', strtotime($hit['_source']['ato']['data_publicacao'] )) }}
                                <br />
                                <strong>Palavras-Chave:</strong>
                                @foreach ($hit['_source']['ato']['tags'] as $tag)
                                    <a href="?query={{$tag}}" class="badge badge-info">
                                        {{ $tag }}
                                    </a>
                                @endforeach
                                <hr class="split-sm">
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#highlight-collapse-{{$hit['_id']}}" aria-expanded="false" aria-controls="collapseExample">
                                    Trechos encontrados
                                </button>

                                <a href="/normativa/pdf/{{ $hit['_id'] }}" class="btn btn-primary" target="_blank">
                                    Baixar
                                </a>
                                <div id="highlight-collapse-{{$hit['_id']}}" class="collapse highlight">
                                @if (!empty($hit['highlight']['attachment.content']))
                                    <small>
                                    <ul class="list-group">
                                        @foreach ($hit['highlight']['attachment.content'] as $highlight)
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
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <nav>
                        <ul class="pagination justify-content-end">
                            @if ($page > 1)
                            <li class="page-item">
                                <a href="?query={{ urlencode($query) }}&page={{ ($page - 1) }}&esfera={{ $esfera }}&fonte={{ $fonte }}&ano={{$ano}}"
                                    class="page-link" tabindex="-1">Anterior</a>
                            </li>
                            @endif

                            @if ($page < $total_pages)
                                <li class="page-item">
                                <a href="?query={{ urlencode($query) }}&page={{ ($page + 1) }}&esfera={{ $esfera }}&fonte={{ $fonte }}&ano={{$ano}}"
                                    class="page-link">Próximo</a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- end pagination-->

        @elseif (isset($hits))
            <div class="row" id="no-results">
                <div class="col-xs-6 col-xs-offset-3">
                    <p>Sem resultados!</p>
                </div>
            </div>
        @endif    
    </div>
</section>
<!-- results -->
<hr class="split">
@endsection

