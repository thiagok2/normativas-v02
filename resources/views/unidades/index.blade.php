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
                <h1>
                    <a href="{{route('index')}}">
                        <img src="/img/normativos-logo.png" srcset="/img/normativos-logo@2x.png 3x" alt="Normativas" />
                    </a>
                </h1>
                <h3><small class="text-muted">Pesquisar conselhos(federais, estaduais e municipais)</small></h3>
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
                <form action="{{route('unidades-search')}}" method="GET" class="">
                    <div class="input-group">
                    <input type="text" name="q" id="q" class="form-control" value="{{$q}}"
                            placeholder="Ex.: Maceió, Alagoas, Distrito Federal..." value="" />
                    </div>
                    <div class="row">
                        <div class="col text-center mt-2 mb-2">
                            <button type="submit" class="btn btn-primary mr-1"><i class="fa fa-search"></i>
                                Pesquisar conselhos
                            </button>
                            <a class="btn btn-info ml-1" href="/" target="_blank">
                                <i class="fa fa-cogs"></i> Atos Normativos
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<hr class="split-sm">

<section id="results">
    <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card mb-3">
                        <div class="card-header">
                            <a href="{{route('unidades-page',$federal->friendly_url)}}">
                                <i class="fa fa-external-link"></i>  {{ $federal->nome }}
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <p>
                                    <strong>Esfera:</strong>
                                    <span class="form-value">{{$federal->esfera}}</span>
                                    <br />
                                    <strong>Sigla:</strong>
                                    <span class="form-value">{{$federal->sigla}}</span>
                                    <br />
                                    <strong>Estado/Município:</strong>
                                    <span class="form-value">
                                        {{$federal->estado['nome'].'('.$federal->estado['sigla'].')'}}
                                    </span>
                                    <br />
                                    <strong>Gestão:</strong><br />
                                    <span class="form-value">{{$federal->contato}}</span><br />
                                    <span class="form-value">{{$federal->contato2}}</span>
                                    </p>

                                </div>

                                <div class="col-lg-6">
                                <p>
                                    <strong>Email:</strong>
                                    <span class="form-value">{{$federal->email}}</span>
                                    <br />
                                    <strong>URL:</strong>
                                    <a class="form-value" href="{{$federal->url}}" target="_blank">{{$federal->url}}</a>
                                    <br />
                                    <strong>Telefone:</strong>
                                    <span class="form-value">
                                            <a href="tel:{{$federal->telefone}}">{{$federal->telefone}}</a>
                                    </span>
                                    <br />
                                    <strong>Endereço:</strong>
                                    <span class="form-value">
                                        <address>{{$federal->endereco}}</address>
                                    </span>
                                </p>
                                </div>
                            </div>
                        </div><!-- end card-body -->

                        @if (isset($federal->confirmado_em))
                        <div class="card-footer">

                            @if (isset($federal->confirmado_em))
                            <div class="col-lg-8">
                                <label class="form-label"><strong>Ingressou na plataforma em:</strong></label>
                                <span class="form-value">{{date('d/m/Y', strtotime($federal->confirmado_em))}}</span>
                            </div>
                            @endif                            
                        </div>
                        @endif


                    </div><!-- end card -->
                </div><!-- end col-10 -->
            </div><!-- end row-->
        @forelse ($unidades as $u)
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card mb-3">
                        <div class="card-header">
                            <a href="{{route('unidades-page',$u->friendly_url)}}">
                                <i class="fa fa-external-link"></i>  {{ $u->nome }}
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                <p>
                                    <strong>Esfera:</strong>
                                    <span class="form-value">{{$u->esfera}}</span>
                                    <br />
                                    <strong>Sigla:</strong>
                                    <span class="form-value">{{$u->sigla}}</span>
                                    <br />
                                    <strong>Estado/Município:</strong>
                                    <span class="form-value">
                                        {{$u->estado['nome'].'('.$u->estado['sigla'].')'}}
                                    </span>
                                    <br />
                                    <strong>Gestão:</strong><br />
                                    <span class="form-value">{{$u->contato}}</span><br />
                                    <span class="form-value">{{$u->contato2}}</span>
                                </p>
                                </div>

                                <div class="col-lg-6">
                                    <strong>Email:</strong>
                                    <span class="form-value">{{$u->email}}</span>
                                    <br />
                                    <strong>URL:</strong>
                                    <a class="form-value" href="{{$u->url}}" target="_blank">{{$u->url}}</a>
                                    <br />
                                    <strong>Telefone:</strong>
                                    <span class="form-value">
                                            <a href="tel:{{$u->telefone}}">{{$u->telefone}}</a>
                                    </span>
                                    <br />
                                    <strong>Endereço:</strong>

                                    <span class="form-value">
                                        <address>{{$u->endereco}}</address>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card-body -->

                        @if (isset($federal->confirmado_em))
                        <div class="card-footer">

                            @if (isset($u->confirmado_em))
                            <div class="col-lg-8">
                                <label class="form-label"><strong>Ingressou na plataforma em:</strong></label>
                                <span class="form-value">{{date('d/m/Y', strtotime($u->confirmado_em))}}</span>
                            </div>
                            @endif                            
                        </div>
                        @endif

                    </div><!-- end card -->
                </div><!-- end col-10 -->
            </div><!-- end row-->
        @empty
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="alert alert-secondary" role="alert">
                        Nenhum resultado encontrado.
                    </div>
                </div>
            </div>

        @endforelse

        <div class="row">
            <div class="col-lg-10 offset-lg-1 d-flex justify-content-center">
                    {{ $unidades->links() }}
            </div>
        </div>

    </div>
</section>

<hr class="split">
@endsection
