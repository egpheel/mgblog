@extends('layout')

@section('navbar')
  @include('partials._navbar')
@endsection

@section('content')
<div class="container login-register">
  <div class="login-register-wrap">
    <div class="login-register-title">Redefinir palavra-passe</div>
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
      {!! csrf_field() !!}
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">E-mail</label>
        <div class="col-md-6">
          <input type="email" class="form-control" placeholder="i.e. joao@exemplo.pt" name="email" value="{{ old('email') }}">
        </div>
      </div>
      <div class="form-group">
        <div class="login-register-btn">
          <button type="submit" class="btn read-more">
            Enviar link de redifinição de palavra-passe
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
