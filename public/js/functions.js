$(document).ready(function() {
  (function(){

      var loading_options = {
          finishedMsg: "<div class='end-msg'>Não existem mais publicações.</div>",
          msgText: "<div class='center'>A carregar mais publicações...</div>",
          img: "data:image/gif;base64,R0lGODlhAQABAHAAACH5BAUAAAAALAAAAAABAAEAAAICRAEAOw=="
      };

      $('.posts').infinitescroll({
        loading: loading_options,
        navSelector: ".posts .pagination",
        nextSelector: ".posts .pagination li.active + li a",
        itemSelector: ".post",
        bufferPx: 1000
      });
  })();
});

$(window).scroll(function() {
  stickySidebar();
});

function stickySidebar() {
  var wScroll = $(window).scrollTop();
  var offset = $('.posts-wrap').offset().top;


  if (wScroll > offset) {
    $('.sidebar').css('margin-top', wScroll - offset);
  } else {
    $('.sidebar').css('margin-top', '0px');
  }
}
