function cerrarVentana(){
  window.close();
}

function ventanaFlotante(ventana){
  //$(ventana).attr('href',$('#link')+'/'+$(ventana).attr('name'));
  window.open($('#link').val()+'/'+$(ventana).attr('name')+'/'+$('#id_activo').val(),
              '_blank',
              'width=800,height=700,scrollbars=yes,menubar=no,status=yes,resizable=yes,screenx=100,screeny=100');
              return false;
}

$('tbody tr').on('click',function (){
  $('td').removeClass( "active-bio" )
  $(this).children('td').addClass( "active-bio" );
  //$('#jump').attr('href','2');
  //alert($('#jump').attr('onclick'));
  $('#id_activo').val($(this).children('input').val());
});

//Inizializando elementos 
$(".button-collapse").sideNav();
