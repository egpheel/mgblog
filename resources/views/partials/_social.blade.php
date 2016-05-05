<div class="social-btns">
  <div class="facebook">
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}" target="_blank">Facebook</a>
  </div>
  <div class="twitter">
    <a class="twitter-share-button" href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}&text={{ $title  }}&hashtags=@foreach($tags as $tag){{ $tag === $tags->last() ? $tag->name : $tag->name . ',' }}@endforeach" target="_blank">Tweet</a>
  </div>
  <div class="googleplus">

  </div>
</div>
