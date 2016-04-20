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
  {{--<section class="content">
    <div class="posts-wrap row">
      <div class="col-md-9">
        <div class="posts">
          <h1>Arquivo de {{ $archive_date }}</h1>

          @include('partials._posts')

        </div>
      </div>
      <div class="col-md-3">
        @include('partials._sidebar')
      </div>
    </div>
  </section>--}}

  <section class="content archive">
    <div class="row">
      <div class="posts-wrap row">
        <div class="col-md-9">
          <div class="posts">
            <h1>Arquivo</h1>
            <h2>{{ $archive_date }}</h2>
            <ul>
            @foreach ($posts as $post)
              <li>
                <div class="archive-post">
                  <a href="{{ route('blog.publicacao', ['year' => $post->created_at->year, 'month' => $post->created_at->month, 'slug' => $post->slug]) }}">{{ $post->title }}</a>
                  <time class="date" datetime="{{ $post->created_at->toAtomString() }}">{{ $post->date }}</time>
                </div>
              </li>
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
