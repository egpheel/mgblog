var mobileNav = false;

$(document).ready(function() {

  mobileNavToggle();

  $(window).resize(checkSize);
});

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
