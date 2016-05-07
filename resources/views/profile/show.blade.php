@extends('layout')

@section('content')
  Nome: {{ $user->name }}<br />
  Email: {{$user->email }}<br />
  Avatar: {{ $user->avatar_vid == '' ? $user->avatar : $user->avatar_vid }}<br />
  Sobre: {{ $user->about }}<br />
  Membro desde: {{ $user->date }}<br />
  Role:
  @foreach ($user->roles as $role)
    {{ $role->name }}{{ $role != $user->roles->last() ? ',' : '' }}
  @endforeach
  <br />
  Número de publicações: {{ $user->posts->count() }}<br />
  Número de comentários: {{ $user->comments->count() }}
@endsection
