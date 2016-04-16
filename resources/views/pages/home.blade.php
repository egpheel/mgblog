@extends('layout')

@section('scripts')
  <!--infinitescroll-->
  <script src="/js/infinitescroll/infinitescroll.js"></script>
  <!--my js-->
  <script src="/js/functions.js"></script>
@endsection

@section('navbar')
  @include('partials._navbar')
@endsection

@section('content')
  <section class="content">
    <div class="row">
      @if (!is_null($featured))
        <div class="featured">
          <hr>
          <div class="img-wrap">
            <img src="/{{ $featured->photo }}" alt="Publicação em destaque">
          </div>
          <hr>
          <div class="featured-post-wrap">
            <h2>{{ $featured->title }}</h2>
            <p>{!! substr($featured->body, 0, 225) !!}{!! strlen($featured->body)>225 ? '...' : '' !!}</p>
            <a href="{{ route('blog.publicacao', ['year' => $featured->created_at->year, 'month' => $featured->created_at->month, 'slug' => $featured->slug]) }}" class="read-more">Ler mais</a>
          </div>
        </div>
      @endif
      <div class="posts-wrap row">
        <div class="col-md-9">
          <div class="posts">

            @include('partials._posts')

          </div>
        </div>
        <div class="col-md-3">
          @include('partials._sidebar')
        </div>
      </div>
    </div>
  </section>

@endsection
