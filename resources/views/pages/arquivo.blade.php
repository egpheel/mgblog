@extends('layout')

@section('title', '- Arquivo')

@section('navbar')
  @include('partials._navbar')
@endsection

@section('content')
  <section class="content archive">
    @include('partials._beautybar', ['page' => 'Arquivo'])
    <div class="posts-wrap row">
      <div class="col-md-9">
        <div class="posts">
          @foreach ($archives as $archive=>$arc)
            <h2>{{ $archive }}</h2>
            <ul>
              @foreach ($arc as $posts=>$post)
                <li>
                  <div class="archive-post">
                    <a href="{{ route('blog.publicacao', ['year' => $post->publish_at->year, 'month' => $post->publish_at->month, 'slug' => $post->slug]) }}">{{ $post->title }}</a>
                    <time class="date" datetime="{{ $post->publish_at->toAtomString() }}">{{ $post->date }}</time>
                  </div>
                </li>
              @endforeach
            </ul>
            @if($arc != $archives->last())
              <hr>
            @endif
          @endforeach
        </div>
      </div>
      <div class="col-md-3 sidebar-show">
        @include('partials._sidebar')
      </div>
    </div>
  </section>
@endsection
