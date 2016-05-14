@extends('layout')

@section('navbar')
  @include('partials._navbar')
@endsection

@section('content')
  <section class="profile">
    <div class="profile-wrap">
      <div class="profile-img">
        <img src="/{{ $user->avatar }}">
      </div>
      <div class="profile-person">
        <p class="name">{{ $user->name }}</p>
        @if(Auth::check() && Auth::user()->id == $user->id)
          <p class="email">{{ $user->email }}</p>
          <span>(o seu email é apenas visível por si)</span>
        @endif
      </div>
      <div class="profile-desc">
        {{ Carbon\Carbon::setLocale('pt') }}
        <p class="since">Membro há {{ $user->created_at->diffForHumans(Carbon\Carbon::now(), true) }}.</p>
        <span>(desde {{ $user->date }})</span>
        @if ($user->hasRole('admin'))
          <p class="counters">{{ $user->posts->count() }} publicações,&nbsp;
        @endif
        {{ $user->comments->count() }} comentários.</p>
        @if ($user->about != '')
          <p class="about-title">Sobre</p>
          <p class="about">{{ $user->about }}</p>
        @endif
      </div>
      @if (Auth::check())
        @if(Auth::user()->id == $user->id)
          <button class="btn btn-block read-more" data-toggle="modal" data-target="#editProfileModal">Editar</button>
          <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="editProfileModalLabel">Editar perfil</h4>
                </div>
                <div class="modal-body">
                  {!! Form::model($user, array('route' => ['profile.update', $user->id], 'method' => 'PUT', 'files' => true)) !!}
                  <div class="form-group">
                    {!! Form::label('avatar', 'Imagem:') !!}
                    <div class="profile-img">
                      <img src="/{{ $user->avatar }}">
                    </div>
                    <em>Alterar imagem (150px x 150px):</em>
                    {!! Form::file('avatar', ['class' => 'form-control'])  !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('name', 'Nome:') !!}
                    {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Nome', 'required' => '', 'maxlength' => '255')) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('email', 'E-mail:') !!}
                    {!! Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'E-mail', 'required' => '')) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('about', 'Sobre:') !!}
                    {!! Form::textarea('about', null, array('class' => 'form-control', 'placeholder' => 'Sobre')) !!}
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  {{ Form::submit('Guardar', array('class' => 'btn btn-success')) }}
                </div>
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        @endif
      @endif
    </div>
  </section>
@endsection
