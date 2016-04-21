@extends('layout')

@section('title', '- Arquivo')

@section('navbar')
  @include('partials._navbar')
@endsection

@section('content')
  <section class="content archive">
    <div class="posts-wrap row">
      <div class="col-md-9">
        <div class="posts">
          <h1>Arquivo</h1>
          @foreach ($archives as $archive=>$arc)
            <h2>{{ $archive }}</h2>
            <ul>
              @foreach ($arc as $posts=>$post)
                <li>
                  <div class="archive-post">
                    <a href="{{ route('blog.publicacao', ['year' => $post->created_at->year, 'month' => $post->created_at->month, 'slug' => $post->slug]) }}">{{ $post->title }}</a>
                    <time class="date" datetime="{{ $post->created_at->toAtomString() }}">{{ $post->date }}</time>
                  </div>
                </li>
              @endforeach
            </ul>
          @endforeach
        </div>
      </div>
      <div class="col-md-3">
        @include('partials._sidebar')
      </div>
    </div>
  </section>
@endsection
