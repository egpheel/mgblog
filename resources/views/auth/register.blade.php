@extends('layout')

@section('navbar')
  @include('partials._navbar')
@endsection

@section('content')
<div class="container login-register">
  <div class="login-register-wrap">
    <div class="login-register-title">
      Registar
    </div>
  <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
      {!! csrf_field() !!}

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Nome</label>

          <div class="col-md-7">
              <input type="text" class="form-control" placeholder="i.e. João Silva" name="name" value="{{ old('name') }}">
          </div>
      </div>

      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">E-mail</label>

          <div class="col-md-7">
              <input type="email" class="form-control" placeholder="i.e. joao@exemplo.pt" name="email" value="{{ old('email') }}">
          </div>
      </div>

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Palavra-passe</label>

          <div class="col-md-7">
              <input type="password" class="form-control" placeholder="Escolha uma palavra-passe" name="password">
          </div>
      </div>

      <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Confirme</label>

          <div class="col-md-7">
              <input type="password" class="form-control" placeholder="Confirme a palavra-passe" name="password_confirmation">
          </div>
      </div>

      <div class="form-group">
          <div class="login-register-btn">
              <button type="submit" class="btn read-more">
                  Registar
              </button>
          </div>
      </div>
  </form>
</div>
</div>
@endsection
