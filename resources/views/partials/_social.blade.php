<div class="social-btns">
  <h3 class="share-title">Partilhe este artigo!</h3>
  <div class="share-wrap">
    <div class="facebook">
      <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;"><span class="socicon-facebook" data-toggle="tooltip" data-placement="top" title="Facebook"></span></a>
    </div>
    <div class="twitter">
      <a class="twitter-share-button" href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}&text={{ $title  }}&hashtags=@foreach($tags as $tag){{ $tag === $tags->last() ? $tag->name : $tag->name . ',' }}@endforeach" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;"><span class="socicon-twitter" data-toggle="tooltip" data-placement="top" title="Twitter"></span> </a>
    </div>
    <div class="googleplus">
      <a href="https://plus.google.com/share?url={{ urlencode($url) }}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;"><span class="socicon-googleplus" data-toggle="tooltip" data-placement="top" title="Google+"></span></a>
    </div>
  </div>
</div>
