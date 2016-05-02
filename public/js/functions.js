$(document).ready(function() {

  $(window).scroll(function() {
    stickySidebar();
  });

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

  comment();
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

function comment() {
  var btn = $('.comment-btn');
  var cmntArea = $('.single-comment-wrap');

  btn.on('click', function(e) {
    var user = $('.user').data('name');
    var img = $('.user').data('img');
    var userid = $('.user').data('userid');
    var postid = $('.user').data('postid');
    var comment = $('textarea').val();
    var d = new Date();
    var time = (d.getDate()<10 ? '0' : '') + d.getDate() + '/' + (d.getMonth()<10 ? '0' : '') + (d.getMonth() + 1) + '/' + d.getFullYear() + ', ' + (d.getHours()<10 ? '0' : '') + d.getHours() + ':' + (d.getMinutes()<10 ? '0' : '') + d.getMinutes();

    e.preventDefault();

    var formData = {
      id: userid,
      name: user,
      text: comment,
      post: postid,
    }
    var type = 'POST';

    if (comment == '') {
      $('textarea').css('background', 'rgba(241, 178, 178, 0.35)')
      $('<p class="req">Este campo é obrigatório:</p>').insertBefore('textarea');
    } else {
      cmntArea.append('<div class="single-comment"><div class="img"><img src="'+ img +'"></div><div class="info"><div class="name">'+ user +'&nbsp;</div><div class="date"> &#8211; <time>'+ time +'</time></div><div class="comment">'+ comment +'</div></div></div>');

      $.ajax({
        type: type,
        url: '/comments',
        data: {
          formData,
          '_token': $('input[name=_token]').val()
        },
        success: function(data) {
          //do something eventually
        },
        error: function(data) {
          console.log('Erro: ' + data);
        }
      });

      $('textarea').val('');
      $('textarea').css('background', '#fff');
      $('.req').remove();
      btn.attr('disabled', true);
      setTimeout(function() {
        btn.attr('disabled', false);
      }, 10000);
    }
  });
}
