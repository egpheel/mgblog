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
    @include('partials._beautybar')
    <div class="posts-wrap row">
      <div class="col-md-9">
        <div class="posts">
          <div class="post">
            <div class="post-info">
              <p class="date">
                <time datetime="{{ $post->created_at->toAtomString() }}">{{ $post->date }}</time>
              </p>
              <h2>{{ $post->title }}</h2>
            </div>
            <div class="post-img-full">
              <img src="/{{ $post->photo }}" alt="Publicação">
            </div>
            <div class="post-info">
              <div class="post-paragraph">
                {!! html_entity_decode(nl2br(e($post->body))) !!}
              </div>
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
            <div class="author">
              <div class="author-img">
                <video autoplay loop muted poster="marcogil-poster.jpg">
                  <source src="/vid/marcogil-up.webm" type="video/webm">
                  <source src="/vid/marcogil-up.mp4" type="video/mp4">
                </video>
              </div>
              <div class="author-desc">
                <div class="name">
                  O meu nome é Marco.
                </div>
                <div class="desc">
                  Um fotógrafo ou contador de histórias, essas histórias que por vezes são estórias, são também vidas com que me cruzo num quotidiano preenchido por gente.
                </div>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        @include('partials._sidebar')
      </div>
    </div>
  </section>

@endsection
