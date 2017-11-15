
$('.moveStock').on('click', 'tr', function(){

  $('td').removeClass( "active-bio" );
  $('a').removeClass(' disabled');

  if ($(this).children('input[name=id_tipo]').val() == 1){
    $('#eliminarBio').addClass('disabled');
  }

  $(this).children('td').addClass( "active-bio" );

  $('#cant-trans').attr('max',$(this).children('td').eq(4).text());
  $('#cant-trans').val(0);
  $('#id_activo').val($(this).children('input').val());
});
