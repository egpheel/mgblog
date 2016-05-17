@extends('layout')

@section('title', '- Resultados da pesquisa')

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
  <section class="content results">
    <div class="featured beauty-bar">
      <hr>
      <div class="img-wrap">
        <img src="/{{ $random_post->photo }}" alt="{{ $random_post->title }}">
      </div>
      <hr>
      <div class="featured-post-wrap">
        <div class="searchBox-flex">
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
      </div>
    </div>
    @if (isset($posts) && isset($query))
      <div class="posts-wrap row">
          <div class="col-md-9">
            <div class="posts">
              @if(!$posts->isEmpty())
                <h1>Resultados da pesquisa por <strong>{{ $query }}</strong>:</h1>

                @include('partials._posts')
              @else
                <h1>Não existem resultados para a sua pesquisa.</h1>
              @endif

            </div>
          </div>
          <div class="col-md-3 sidebar-show">
            @include('partials._sidebar')
          </div>
        </div>
      </div>
    @endif
  </section>

@endsection
