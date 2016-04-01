@extends('layout')

@section('scripts')
  <!--infinitescroll-->
  <script src="/js/infinitescroll/infinitescroll.js"></script>
  <!--my js-->
  <script src="/js/functions.js"></script>
@endsection

@section('title', '- '. $post->title)

@section('navbar')
  @include('partials._navbar')
@endsection

@section('content')
  <section class="content">
    <div class="posts-wrap">
      <div class="posts">
        <div class="post">
          <div class="post-info">
            <p class="date">
              <time datetime="{{ $post->created_at->toAtomString() }}">{{ $post->date }}</time>
            </p>
            <h2>{{ $post->title }}</h2>
          </div>
          <div class="post-img">
            <img src="/img/post-temp.jpg" alt="Publicação">
          </div>
          <div class="post-info">
            <p>{!! nl2br(e($post->body)) !!}</p>
            @unless ($post->tags->isEmpty())
              <ul>
                @foreach ($post->tags as $tag)
                  <a href="#">
                    <li>{{ $tag->name }}</li>
                  </a>
                @endforeach
              </ul>
            @endunless
          </div>
          <hr>
        </div>
      </div>
      @include('partials._sidebar')
    </div>
  </section>

@endsection
