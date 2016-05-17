var mobileNav = false;

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

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  });

  comment();
  editComment();
  deleteComment();

  mobileNavToggle();

  $(window).resize(checkSize);
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
    var user = $('.req-details').data('name');
    var img = $('.req-details').data('img');
    var userid = $('.req-details').data('userid');
    var postid = $('.req-details').data('postid');
    var isAdmin = $('.req-details').data('admin');

    var comment = $('.new-comment').val();
    var d = new Date();
    var time = (d.getDate()<10 ? '0' : '') + d.getDate() + '/' + (d.getMonth()<10 ? '0' : '') + (d.getMonth() + 1) + '/' + d.getFullYear() + ', ' + (d.getHours()<10 ? '0' : '') + d.getHours() + ':' + (d.getMinutes()<10 ? '0' : '') + d.getMinutes();

    e.preventDefault();

    var formData = {
      id: userid,
      name: user,
      text: comment,
      post: postid,
    }

    if (comment == '') {
      $('.new-comment').css('background', 'rgba(241, 178, 178, 0.35)')
      $('.req').remove();
      $('<p class="req">Este campo é obrigatório:</p>').insertBefore('.new-comment');
    } else {
      if (isAdmin) {
        cmntArea.append('<div class="single-comment owned"><a href="/perfil/'+ userid +'"><div class="img"><img src="/'+ img +'"></div></a><div class="info"><a href="/perfil/'+ userid +'"><div class="name admin">'+ user +'&nbsp;</div></a><div class="date"> &#8211; <time>'+ time +'</time></div><div class="comment">'+ comment +'</div></div></div>');
      } else {
        cmntArea.append('<div class="single-comment owned"><a href="/perfil/'+ userid +'"><div class="img"><img src="/'+ img +'"></div></a><div class="info"><a href="/perfil/'+ userid +'"><div class="name">'+ user +'&nbsp;</div></a><div class="date"> &#8211; <time>'+ time +' </time></div><div class="comment">'+ comment +'</div></div></div>');
      }

      $.ajax({
        type: 'POST',
        url: '/comments',
        data: {
          formData,
          '_token': $('input[name=_token]').val()
        },
        success: function(response) {
          $('.single-comment:last-child .info').append('<textarea class="form-control edit-comment" rows="5" data-id="' + response['id'] + '"></textarea>');
          $('.single-comment:last-child').append('<div class="edit-comment-wrap"><div class="btn edit-btn" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></div><div class="btn delete-btn" data-toggle="tooltip" data-placement="top" title="Apagar"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></div></div>').fadeIn('slow');
          editComment();
          deleteComment();
        },
        error: function(data) {
          console.log('Erro: ' + data);
        }
      });

      $('.new-comment').val('');
      $('.new-comment').css('background', '#fff');
      $('.req').remove();
      $('.no-comment-wrap').remove();
      btn.attr('disabled', true);
      setTimeout(function() {
        btn.attr('disabled', false);
      }, 10000);
    }
  });
}

function editComment() {
  var btn = $('.edit-btn');
  var editCommentArea = $('.edit-comment');
  var comment = $('.comment');

  btn.bind('click', function () {
    var $this = $(this);
    var comment = $this.parent().parent().find('.comment');
    editCommentArea = $this.parent().parent().find('.edit-comment');
    editCommentArea.text(comment.text());
    comment.hide();
    editCommentArea.show().focus();
    $this.attr('disabled', true);
  });

  editCommentArea.on('blur', function () {
    var $this = $(this);
    var dateElem = $this.parent().parent().find('.date');
    comment = $this.parent().parent().find('.comment');
    var origComment = comment.html();
    var d = new Date();
    var time = (d.getDate()<10 ? '0' : '') + d.getDate() + '/' + (d.getMonth()<10 ? '0' : '') + (d.getMonth() + 1) + '/' + d.getFullYear() + ', ' + (d.getHours()<10 ? '0' : '') + d.getHours() + ':' + (d.getMinutes()<10 ? '0' : '') + d.getMinutes();

    comment.html(editCommentArea.val());
    comment.show();
    editCommentArea.hide();
    if (comment.html() != origComment) {
      $this.parent().parent().find('.edited').remove();
      dateElem.find('time').text(time);
      dateElem.append('<em class="edited">&nbsp;(editado)</em>');

      var commentid = editCommentArea.data('id');
      var editedcomment = editCommentArea.val();

      var formData = {
        text: editedcomment,
      }

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        type: 'POST',
        url: '/comments/' + commentid,
        data: {
          formData,
          _method: 'PATCH',
        },
        success: function(data) {
          //do something eventually
        },
        error: function(data) {
          console.log('Erro: ' + data);
        }
      });
    }
    btn.attr('disabled', false);
  });
}

function deleteComment() {
  var btn = $('.delete-btn');

  btn.on('click', function () {
    var $this = $(this);
    var comment = $this.parent().parent().find('.edit-comment');
    var commentid = comment.data('id');
    var commentwrapper = $this.parent().parent();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    swal({
      title: 'Tem a certeza?',
      text: 'Se apagar este comentário não poderá recuperá-lo.',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Apagar',
      confirmButtonColor: '#e74646',
      cancelButtonText: 'Cancelar',
      preConfirm: function() {
        return new Promise(function(resolve) {
          swal.enableLoading();
          $.ajax({
            type: 'POST',
            url: '/comments/' + commentid,
            data: {
              _method: 'DELETE',
            },
            success: function(data) {
              resolve();
            },
            error: function(data) {
              console.log('Erro: ' + data);
            }
          });

        });
      },
      allowOutsideClick: true
    }).then(function(isConfirm) {
      if (isConfirm) {
        swal({
          title: 'Comentário apagado com sucesso',
          confirmButtonText: 'Fechar',
          confirmButtonColor: '#36b360',
          type: 'success'
        });
        commentwrapper.remove();
      }
    });
  });
}

function mobileNavToggle() {
  var btn = $('.mobile-menu-wrap');
  var menu = $('.navbar-mobile > ul.menu');
  var header = $('.header');

  btn.on('click', function () {
    if (mobileNav) {
      menu.fadeOut('fast');
      mobileNav = false;
      header.animate({
        marginTop: "75px"
      });
    } else {
      menu.fadeIn();
      mobileNav = true;
      header.animate({
        marginTop: "285px"
      });
    }
  });
}

function checkSize() {
  var check = $('.navbar-mobile');
  var header = $('.header');

  if(check.css('display') != 'block') {
    header.css('margin-top', '75px');
  } else {
    if (mobileNav) {
      header.css('margin-top', '285px');
    }
  }
}
