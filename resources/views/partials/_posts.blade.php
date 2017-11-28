@foreach ($posts as $post)
  <div class="post">
    <div class="post-info">
      <p class="date">
        <time datetime="{{ $post->publish_at->toAtomString() }}">{{ $post->date }}</time>, <span>por {{ $post->user->name }}</span>
      </p>
      <h2><a class='title' href="{{ route('blog.publicacao', ['year' => $post->publish_at->year, 'month' => $post->publish_at->month, 'slug' => $post->slug]) }}">{{ $post->title }}</a></h2>
    </div>
    <a href="{{ route('blog.publicacao', ['year' => $post->publish_at->year, 'month' => $post->publish_at->month, 'slug' => $post->slug]) }}">
      <div class="post-img">
        <img src="/{{ $post->photo }}" alt="Publicação">
      </div>
    </a>
    <div class="post-info">
      <div class="post-paragraph">{!! html_entity_decode(substr(nl2br(e($post->body)), 0, 500)) !!}{!! html_entity_decode(strlen(nl2br(e($post->body))))>500 ? '...' : '' !!}</div>
      @if (strlen(nl2br(e($post->body)))>500)
        <div class="read-more-container">
          <a href="{{ route('blog.publicacao', ['year' => $post->publish_at->year, 'month' => $post->publish_at->month, 'slug' => $post->slug]) }}" class="read-more btn-block">Ler mais</a>
        </div>
      @endif
        <div class="comentarios">
          <a href="{{ route('blog.publicacao', ['year' => $post->publish_at->year, 'month' => $post->publish_at->month, 'slug' => $post->slug]) }}#comentarios" class="comentar btn-block">{{ $post->comments->count() === 0 ? 'Comentar' : ($post->comments->count() === 1 ? $post->comments->count() . ' comentário' : $post->comments->count() . ' comentários') }}</a>
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
    @if($post != $posts->last())
      <hr />
    @endif
  </div>
@endforeach
{!! $posts->links() !!}
