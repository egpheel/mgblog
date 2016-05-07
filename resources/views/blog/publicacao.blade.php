@extends('layout')

@section('meta')
  <meta property="og:title" content="{{ $post->title }}"/>
  <meta property="og:url" content="{{ request()->fullUrl() }}">
  <meta property="og:image" content="{{ url('/') . '/' . $post->photo }}"/>
  <meta property="og:site_name" content="Marco Gil"/>
  <meta property="og:description" content="{!! strip_tags(html_entity_decode(substr(nl2br(e($post->body)), 0, 500))) !!}"/>
@endsection

@section('stylesheets')
  <link rel="stylesheet" href="/css/parsley.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/2.1.1/sweetalert2.min.css">
  <link href="https://file.myfontastic.com/n6vo44Re5QaWo8oCKShBs7/icons.css" rel="stylesheet">
@endsection

@section('scripts')
  <script src="/js/parsley/parsley.js"></script>
  <script src="/js/parsley/pt-pt.js"></script>
  <!--infinitescroll-->
  <script src="/js/infinitescroll/infinitescroll.js"></script>
  <!--sweet alert-->
  <script src="https://cdn.jsdelivr.net/sweetalert2/2.1.1/sweetalert2.min.js"></script>
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
                    <a href="{{ route('blog.tags', ['tag' => $tag->name]) }}">
                      <li>{{ $tag->name }}</li>
                    </a>
                  @endforeach
                </ul>
              @endunless
            </div>
            @include('partials._social', ['url' => request()->fullUrl(), 'title' => $post->title, 'tags' => $post->tags])
            <div class="author">
              <div class="author-img">
                @if ($post->user->avatar_vid != '')
                  <video autoplay loop muted>
                    <source src="/vid/{{ explode(';', $post->user->avatar_vid)[0] }}" type="video/webm">
                    <source src="/vid/{{ explode(';', $post->user->avatar_vid)[1] }}" type="video/mp4">
                  </video>
                @else
                  <img src="{{ $post->user->avatar }}">
                @endif
              </div>
              <div class="author-desc">
                <div class="name">
                  O meu nome é {{ explode(' ', $post->user->name)[0] }}.
                </div>
                <div class="desc">
                  {{ $post->user->about }}
                </div>
              </div>
            </div>
            @include('../partials/_comments')
          </div>
        </div>
      </div>
      <div class="col-md-3">
        @include('partials._sidebar')
      </div>
    </div>
  </section>

@endsection
