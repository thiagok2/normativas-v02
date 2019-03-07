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
                                <i class="fa fa-search"></i> Pesquisar Atos Normativos
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
                    <div class="card mb-3 border-dark">
                        <div class="card-header">
                            <a href="{{route('unidades-page',$federal->id)}}">
                                <i class="fa fa-external-link"></i>  {{ $federal->nome }}
                            </a>
                        </div>
    
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="form-label">Esfera:</label>
                                    <span class="form-value">{{$federal->esfera}}</span> 
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Sigla:</label>
                                    <span class="form-value">{{$federal->sigla}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Estado/Município:</label>
                                    <span class="form-value">
                                        {{$federal->estado['nome'].'('.$federal->estado['sigla'].')'}}
                                    </span>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="form-label">Email:</label>
                                    <span class="form-value">{{$federal->email}}</span>
                                    
                                </div>
                                <div class="col-lg-4">
                                    
                                    <label class="form-label">URL:</label>
                                    <a class="form-value" href="{{$federal->url}}" target="_blank">{{$federal->url}}</a>
                                    
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Telefone:</label>
                                    <span class="form-value">
                                            <a href="tel:{{$federal->telefone}}">{{$federal->telefone}}</a>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="form-label">Gestão:</label>
                                    <span class="form-value">{{$federal->contato}}</span>
                                    
                                </div>
                                <div class="col-lg-4">
                                    <span class="form-value">{{$federal->contato2}}</span> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="form-label">Endereço:</label>
                                    
                                    <span class="form-value">
                                        <address>{{$federal->endereco}}</address>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card-body -->

                        <div class="card-footer">

                            @if (isset($federal->confirmado_em))
                            <div class="col-lg-8">
                                <label class="form-label">Ingressou na plataforma em:</label>
                                <span class="form-value">{{date('d/m/Y', strtotime($federal->confirmado_em))}}</span>
                            </div>
                            @endif

                            @if ($federal->documentos_count > 0)
                            <div class="col-lg-4">
                                <label class="form-label">Atos normativos enviados:</label>
                                <span class="form-value">{{$federal->documentos_count}}</span>
                            </div>
                            @endif
    
                        </div>

                    </div><!-- end card -->
                </div><!-- end col-10 -->
            </div><!-- end row-->
        @forelse ($unidades as $u)
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card mb-3 @if ($u->documentos_count > 0) border-secondary @else border-light @endif ">
                        <div class="card-header">
                            <a href="{{route('unidades-page',$u->id)}}">
                                <i class="fa fa-external-link"></i>  {{ $u->nome }}
                            </a>
                        </div>
    
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="form-label">Esfera:</label>
                                    <span class="form-value">{{$u->esfera}}</span> 
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Sigla:</label>
                                    <span class="form-value">{{$u->sigla}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Estado/Município:</label>
                                    <span class="form-value">
                                        {{$u->estado['nome'].'('.$u->estado['sigla'].')'}}
                                    </span>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="form-label">Email:</label>
                                    <span class="form-value">{{$u->email}}</span>
                                    
                                </div>
                                <div class="col-lg-4">
                                    
                                    <label class="form-label">URL:</label>
                                    <a class="form-value" href="{{$u->url}}" target="_blank">{{$u->url}}</a>
                                    
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Telefone:</label>
                                    <span class="form-value">
                                            <a href="tel:{{$u->telefone}}">{{$u->telefone}}</a>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="form-label">Gestão:</label>
                                    <span class="form-value">{{$u->contato}}</span>
                                    
                                </div>
                                <div class="col-lg-4">
                                    <span class="form-value">{{$u->contato2}}</span> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="form-label">Endereço:</label>
                                    
                                    <span class="form-value">
                                        <address>{{$u->endereco}}</address>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card-body -->

                        <div class="card-footer">

                            @if (isset($u->confirmado_em))
                            <div class="col-lg-8">
                                <label class="form-label">Ingressou na plataforma em:</label>
                                <span class="form-value">{{date('d/m/Y', strtotime($u->confirmado_em))}}</span>
                            </div>
                            @endif

                            @if ($u->documentos_count > 0)
                            <div class="col-lg-4">
                                <label class="form-label">Atos normativos enviados:</label>
                                <span class="form-value">{{$u->documentos_count}}</span>
                            </div>
                            @endif
    
                        </div>

                    </div><!-- end card -->
                </div><!-- end col-10 -->
            </div><!-- end row-->
        @empty
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <div class="alert alert-secondary" role="alert">
                        Nenhum resultado encontrado.
                    </div>
                </div>
            </div>
            
        @endforelse

        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                    {{ $unidades->links() }}
            </div>
        </div>
        
    </div>
</section>

<hr class="split">
@endsection