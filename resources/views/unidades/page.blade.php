@extends('layouts.master')

@section('content')
<!-- header -->
<section id="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-right p-0 ">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('home') }}">Home</a>
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
                <h1><img src="/img/normativos-logo.png" srcset="/img/normativos-logo@2x.png 3x" alt="Normativas" /></h1>
                <h3><small class="text-muted">Pesquisar conselhos(federal, estaduais e municipais)</small></h3>
            </div>
        </div>
    </div>
</section>
<!-- end header -->
<section id="unidade">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card mb-3">
                    <div class="card-header">
                        <a href="#">
                            <i class="fa fa-external-link"></i>  {{ $unidade->nome }}
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <strong> Esfera:</strong>
                                <span class="form-value">{{$unidade->esfera}}</span>
                                <br />
                                <strong> Sigla:</strong>
                                <span class="form-value">{{$unidade->sigla}}</span>
                                <br />
                                <strong> Estado/Município:</strong>
                                <span class="form-value">
                                    {{$unidade->estado['nome'].'('.$unidade->estado['sigla'].')'}}
                                </span>
                                <br />
                                <strong> Gestão:</strong><br />
                                <span class="form-value">{{$unidade->contato}}</span>
                                <span class="form-value">{{$unidade->contato2}}</span>

                            </div>

                            <div class="col-lg-6">
                                <strong> Email:</strong>
                                <span class="form-value">{{$unidade->email}}</span>
                                <br />
                                <strong> URL:</strong>
                                <a class="form-value" href="{{$unidade->url}}" target="_blank">{{$unidade->url}}</a>
                                <br />
                                <strong> Telefone:</strong>
                                <span class="form-value">
                                        <a href="tel:{{$unidade->telefone}}">{{$unidade->telefone}}</a>
                                </span>
                                <br />
                                <strong> Endereço:</strong>

                                <span class="form-value">
                                    <address>{{$unidade->endereco}}</address>
                                </span>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-lg-4">
                                <a href="javascript:history.back();" class="btn btn-primary pull-left"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Voltar</a>
                            </div>
                            @if (isset($unidade->confirmado_em))
                            <div class="col-lg-4">
                                <label class="form-label">Ingressou em:</label>
                                <span class="form-value">{{date('d/m/Y', strtotime($unidade->confirmado_em))}}</span>
                            </div>
                            @endif

                            @if ($unidade->documentos_count > 0)
                            <div class="col-lg-4">
                                <label class="form-label">Atos normativos enviados:</label>
                                <span class="form-value">{{$unidade->documentos_count}}</span>
                            </div>
                            @endif

                        </div>
                    </div><!-- end card-body -->

                </div><!-- end card -->
            </div><!-- end col-10 -->
        </div>

        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div id="accordion">

                    @forelse ($tiposTotal as $i => $tipo)
                        <div class="card">
                            <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_{{$tipo->id}}" aria-expanded="true" aria-controls="collapseOne">
                                  {{$tipo->tipo}}   ({{$tipo->total}})
                                </button>
                            </h5>
                            </div>

                            <div id="collapse_{{$tipo->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                @foreach ($documentos as $k => $docs)
                                    @if ($k === $tipo->id)
                                        <ul class="list-group">
                                            @foreach ($docs as $d)
                                            <li class="list-group-item">
                                                Número: {{$d->numero}}
                                                <div class="pull-right">
                                                    {{$d->assunto->nome}}
                                                </div>
                                                <br/>
                                                {{$d->titulo}}
                                                <div class="pull-right">{{$d->ano}}</div>
                                                <br/>
                                                Ementa: <small class="text-muted">
                                                        {{$d->ementa}}
                                                </small>
                                                <br/>
                                                <a href="{{ route("pdfNormativa",$d->arquivo) }}">
                                                    <span class="badge badge-secondary">Download</span>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
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

</section>

<hr class="split">
@endsection
