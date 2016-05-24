<div class="featured beauty-bar">
  <hr>
  <div class="img-wrap" style="background-image: url('/{{ $random_post->photo }}'); background-position: center center; background-repeat: no-repeat;">
    @if (isset($page))
      <div class="featured-post-wrap">
        <h2>{{ $page }}</h2>
      </div>
    @endif
  </div>
  <hr>
</div>
