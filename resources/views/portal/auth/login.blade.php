@extends('layouts.login')
@section('content')
    <h4>Bienvenido!</h4>
    <form method="POST" class="pt-3" action="{{ route('portal.login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                        <i class="fa fa-user text-primary"></i>
                    </span>
                </div>
                <input type="email" class="form-control form-control-lg border-left-0" name="email" id="email" placeholder="">
                @if ($errors->has('email'))
                    <span class="invalid-feedback d-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                        <i class="fa fa-lock text-primary"></i>
                    </span>
                </div>
                <input type="password" class="form-control form-control-lg border-left-0" name="password" id="password" placeholder="">
                @if ($errors->has('password'))
                    <span class="invalid-feedback d-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        {{--<div class="my-2 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <label class="form-check-label text-muted">
                    <input type="checkbox" class="form-check-input">
                    Keep me signed in
                </label>
            </div>
            <a href="#" class="auth-link text-black">Forgot password?</a>
        </div>--}}
        <div class="form-group">
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn pb-5" type="submit"><i class="fa fa-sign-in-alt" aria-hidden="true"></i> {{ __('Ingresar') }}</button>
        </div>
        <div class="form-group text-center">
            <hr>
            <a href="{{ route('portal.register') }}">Crear Cuenta</a>
        </div>
        {{--<div class="mb-2 d-flex">
            <button type="button" class="btn btn-facebook auth-form-btn flex-grow mr-1">
                <i class="fab fa-facebook-f mr-2"></i>Facebook
            </button>
            <button type="button" class="btn btn-google auth-form-btn flex-grow ml-1">
                <i class="fab fa-google mr-2"></i>Google
            </button>
        </div>--}}
    </form>
@endsection
@section('login_half_bg')
    <div class="col-lg-6 login-half-bg d-flex flex-row" style="background: url('https://images.pexels.com/photos/1081228/pexels-photo-1081228.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260');background-size: cover">
        <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2018  All rights reserved.</p>
    </div>
@endsection