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
            <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>
            <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> {{ trans('adminlte::adminlte.remember_me') }}
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit"
                                class="btn btn-primary btn-block btn-flat" id="login">{{ trans('adminlte::adminlte.sign_in') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            
            <div class="auth-links">
                <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}" 
                    class="text-center">
                    {{ trans('adminlte::adminlte.i_forgot_my_password') }}
                </a>
                <br>
                <a href="{{ route('primeiro-acesso') }}" 
                    class="text-center">
                    Primeiro acesso?
                </a>
                <br>
                <br>
                @if(getenv('APP_ENV')=='local')
                    <div class="alert alert-success">
                        <strong>Você está no ambiente de desenvolvimento</strong><br/>
                        <i>Clique para fazer login como:</i><br/><br/>   
                        <div class="btn-group">                                           
                            <button class="btn btn-success" onclick="logar('normativas@nees.com.br','123456')">Admin</button>                        
                            <button class="btn btn-success" onclick="logar('cneagendamento@mec.gov.br','123456')">Gestor</button>
                            <button class="btn btn-success" onclick="logar('uncmenacional2018@gmail.com','987654321')">Acessor</button>
                            <button class="btn btn-success" onclick="logar('ceeal@extrator.com.br','extrator')">Extrator</button>
                        </div>
                    </div>
                    <script src="{{ asset('js/app-local-login.js') }}"></script>
                @endif                
                <p class="text-muted">
                Caso tenha problemas de acesso, envie email para normativas@nees.com.br
                </p>
                <!--
                @if (config('adminlte.register_url', 'register'))
                    <a href="{{ url(config('adminlte.register_url', 'register')) }}"
                       class="text-center"
                    >{{ trans('adminlte::adminlte.register_a_new_membership') }}</a>
                @endif
                -->
            </div>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@stop
