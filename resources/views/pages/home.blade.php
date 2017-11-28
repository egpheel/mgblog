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
        <div class="featured featured-home">
          <hr>
          <div class="img-wrap" style="background-image: url('/{{ $featured->photo }}'); background-position: center center; background-repeat: no-repeat;">
            <div class="featured-post-wrap">
              <div class="searchBox-flex home-search">
                <div class="searchBox">
                  {!! Form::open(['route' => 'search.results', 'method' => 'GET', 'class' => 'searchForm form-inline']) !!}
                  <div class="input-group">
                    {!! Form::text('pesquisa', null, ['class' => 'searchBox-input form-control', 'placeholder' => 'Pesquisar']) !!}
                    <div class="input-group-btn">
                      {!! Form::button('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>', ['type' => 'submit', 'class' => 'btn btn-default searchBox-btn']) !!}
                    </div>
                  </div>
                  {!! Form::close() !!}
                </div>
              </div>
              <h2>{{ $featured->title }}</h2>
              <div class="featured-body">{!! strip_tags(substr($featured->body, 0, 225), '<br>') !!}{!! strip_tags(strlen($featured->body), '<br>')>225 ? '...' : '' !!}</div>
              <div class="text-center">
                <a href="{{ route('blog.publicacao', ['year' => $featured->publish_at->year, 'month' => $featured->publish_at->month, 'slug' => $featured->slug]) }}" class="read-more">Ler mais</a>
              </div>
            </div>
          </div>
          <hr>
        </div>
      @endif
      <div class="posts-wrap row">
        <div class="col-md-9">
          <div class="posts">
            @include('partials._posts')
          </div>
        </div>
        <div class="col-md-3 sidebar-show">
          @include('partials._sidebar')
        </div>
      </div>
    </div>
  </section>

@endsection
