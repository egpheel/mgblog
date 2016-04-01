@foreach ($posts as $post)
  <div class="post">
    <div class="post-info">
      <p class="date">
        <time datetime="{{ $post->created_at->toAtomString() }}">{{ $post->date }}</time>
      </p>
      <h2><a class='title' href="{{ route('blog.publicacao', ['year' => $post->created_at->year, 'month' => $post->created_at->month, 'slug' => $post->slug]) }}">{{ $post->title }}</a></h2>
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
@endforeach
{!! $posts->render() !!}
