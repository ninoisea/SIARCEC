@extends('layouts.frontend')

@section('title', 'Registro | ')

@section('content')
<div class="peers ai-s fxw-nw h-100vh">
    <div class="peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style='background-image: url("/images/bg.jpg")'>
        <div class="pos-a centerXY">
            <div class="bgc-white bdrs-50p pos-r" style='width: 120px; height: 120px;'>
                <img class="pos-a centerXY" src="/images/logo_pequeno.png" alt="logo" height="110px">
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style='min-width: 320px;'>
        <h4 class="fw-300 c-grey-900 mB-40">Registro</h4>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name" class="col-form-label text-md-right text-normal"><span class="fa fa-user-circle"></span> {{ __('Nombre del usuario:') }}</label>
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="last_name" class="col-form-label text-md-right text-normal"><span class="fa fa-user-circle-o"></span> {{ __('Apellido del usuario:') }}</label>
                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>

                @if ($errors->has('last_name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="num_id" class="col-form-label text-md-right text-normal"><span class="fa fa-id-card"></span> {{ __('Cédula del usuario:') }}</label>
                <input id="num_id" type="text" class="form-control{{ $errors->has('num_id') ? ' is-invalid' : '' }}" name="num_id" value="{{ old('num_id') }}" required autofocus>

                @if ($errors->has('num_id'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('num_id') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="email" class="col-form-label text-md-right "><span class="fa fa-envelope"></span> {{ __('Correo Electronico:') }}</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="password" class="col-form-label text-md-right "><span class="fa fa-lock"></span> {{ __('Contraseña:') }}</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required>

                @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="col-form-label text-md-right "><span class="fa fa-lock"></span> {{ __('Confirme Contraseña:') }}</label>
                <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" value="{{ old('password_confirmation') }}" required>

                @if ($errors->has('password_confirmation'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">
                    {{ __('Registrarse') }}
                </button>
                <a class="btn btn-link" href="{{ route('login') }}">
                    {{ __('Ya estoy registrado.') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
