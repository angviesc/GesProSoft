function cerrarVentana(){
  window.close();
}

$('tbody tr').on('click',function (){
  $('td').removeClass( "active-bio" )
  $(this).children('td').addClass( "active-bio" );
  //$('#jump').attr('href','2');
  //alert($('#jump').attr('onclick'));
  //alert($(this).children('input').val())
});
