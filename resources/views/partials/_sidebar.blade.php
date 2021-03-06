<div class="sidebar">
  <p>Publicações recentes</p>
  <ul>
    @foreach ($recent_posts as $post)
      <li>
        <a href="{{ route('blog.publicacao', ['year' => $post->publish_at->year, 'month' => $post->publish_at->month, 'slug' => $post->slug]) }}">{{ $post->title }}</a>
      </li>
    @endforeach
  </ul>
  <hr>
  <p>Mais categorias</p>
  <ul class='tags'>
    @foreach ($tags as $tag)
      @if (!$tag->posts->isEmpty())
        <a href="{{ route('blog.tags', ['tag' => $tag->name]) }}">
          <li>{{ $tag->name }}</li>
        </a>
      @endif
    @endforeach
  </ul>
  <hr>
  <p>Arquivo</p>
  <ul>
    @foreach($archives as $archive=>$arc)
      <li>
        <a href="{{ route('blog.arquivo', ['year' => $arc->first()->publish_at->year, 'month' => $arc->first()->publish_at->month]) }}">{{ $archive }}</a>
      </li>
    @endforeach
  </ul>
</div>
