@extends('layout')

@section('navbar')
  @include('partials._navbar')
@endsection

@section('content')
  <div class="container login-register">
    <div class="login-register-wrap">
      <div class="login-register-title">
        Iniciar sessão
      </div>
      <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
        {!! csrf_field() !!}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">E-mail</label>
          <div class="col-md-7">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
          </div>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Palavra-passe</label>
          <div class="col-md-7">
            <input type="password" class="form-control" name="password">
          </div>
        </div>
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="remember"> Manter-me ligado
            </label>
          </div>
        </div>

        <div class="login-register-btn">
          <button type="submit" class="btn read-more">
            Iniciar sessão
          </button>
        </div>
        <div class="forgot-pass-no-account">
          <a href="{{ url('/password/reset') }}">Esqueceu-se da palavra-passe?</a>
          <p>Ainda não tem conta? <a href="/register">Clique aqui para se registar.</a></p>
        </div>
      </form>
    </div>
  </div>
@endsection
