<div class="featured beauty-bar">
  <hr>
  <div class="img-wrap">
    <img src="/{{ $random_post->photo }}" alt="{{ $random_post->title }}">
  </div>
  <hr>
  @if (isset($page))
    <div class="featured-post-wrap">
      <h2>{{ $page }}</h2>
    </div>
  @endif
</div>
