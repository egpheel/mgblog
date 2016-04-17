@extends('layout')

@section('title', '- Categorias')

@section('navbar')
  @include('partials._navbar')
@endsection

@section('content')
  <section class="content">
    <div class="row">
      <div class="posts-wrap row">
        <div class="col-md-9">
          <div class="posts">
            <h1>Categorias</h1>
            <ul>
              @foreach ($tags as $tag)
                <li><a href="#">{{ $tag->name }}</a></li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="col-md-3">
          @include('partials._sidebar')
        </div>
      </div>
    </div>
  </section>
@endsection
