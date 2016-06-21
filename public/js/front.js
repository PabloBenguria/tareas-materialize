$(function() {

  $(".button-collapse").sideNav();

  $('.dropdown-button').dropdown({
    inDuration: 300,
    outDuration: 225,
    constrain_width: false,
    hover: false,
    gutter: 0,
    belowOrigin: true,
    alignment: 'left'
  });

  $('.dropdown-button-mobile').dropdown({
    inDuration: 300,
    outDuration: 225,
    constrain_width: true,
    hover: false,
    gutter: 0,
    belowOrigin: true
  });

  $('select').material_select();

  $('.close').on('click', function(){
    $('.content-alert').css('display', 'none');
  });

});
