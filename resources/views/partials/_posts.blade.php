@foreach ($posts as $post)
  <div class="post">
    <div class="post-info">
      <p class="date">
        <time datetime="{{ $post->created_at->toAtomString() }}">{{ $post->date }}</time>
      </p>
      <h2><a class='title' href="{{ route('blog.publicacao', ['year' => $post->created_at->year, 'month' => $post->created_at->month, 'slug' => $post->slug]) }}">{{ $post->title }}</a></h2>
    </div>
    <div class="post-img">
      <img src="/{{ $post->photo }}" alt="Publicação">
    </div>
    <div class="post-info">
      <p>{!! substr(nl2br(e($post->body)), 0, 500) !!}{!! strlen(nl2br(e($post->body)))>500 ? '...' : '' !!}</p>
      @if (strlen(nl2br(e($post->body)))>500)
        <div class="read-more-container">
          <a href="{{ route('blog.publicacao', ['year' => $post->created_at->year, 'month' => $post->created_at->month, 'slug' => $post->slug]) }}" class="read-more btn-block">Ler mais</a>
        </div>
      @endif
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
    <hr>
  </div>
@endforeach
{!! $posts->render() !!}
