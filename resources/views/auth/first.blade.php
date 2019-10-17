@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')

    @include('admin.includes.alerts')
    
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'admin/home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>
        
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">
                Informe o email registrado no Normativas
            </p>
            <form action="{{ route("solicitar-acesso") }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit"
                                class="btn btn-primary btn-block">
                                Solicitar acesso
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            
        </div>
        
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop