<div class="social-btns">
  <div class="facebook">
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;">Facebook</a>
  </div>
  <div class="twitter">
    <a class="twitter-share-button" href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}&text={{ $title  }}&hashtags=@foreach($tags as $tag){{ $tag === $tags->last() ? $tag->name : $tag->name . ',' }}@endforeach" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;">Tweet</a>
  </div>
  <div class="googleplus">
    <a href="https://plus.google.com/share?url={{ urlencode($url) }}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;">Google+</a>
  </div>
</div>
