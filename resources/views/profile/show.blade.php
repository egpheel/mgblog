@extends('layout')

@section('navbar')
  @include('partials._navbar')
@endsection

@section('content')
  <section class="profile">
    <div class="profile-wrap">
      Nome: {{ $user->name }}<br />
      Email: {{$user->email }}<br />
      Avatar: {{ $user->avatar }}<br />
      Sobre: {{ $user->about }}<br />
      Membro desde: {{ $user->date }}<br />
      Role:
      @foreach ($user->roles as $role)
        {{ $role->name }}{{ $role != $user->roles->last() ? ',' : '' }}
      @endforeach
      <br />
      Número de publicações: {{ $user->posts->count() }}<br />
      Número de comentários: {{ $user->comments->count() }}
      @if (Auth::check())
        @if(Auth::user()->id == $user->id)
          <a href="#" data-toggle="modal" data-target="#editProfileModal">Editar</a>
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
