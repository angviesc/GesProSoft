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

function validaBio(formulario){
  if (formulario.name){
    if ($('#ctrl-active').prop('checked')){
      if ($('#password').val().localeCompare($('#password2').val()) == 0){
        return true;
      }else{
        alert('Las contraseñas deben coincidir');
        return false;
      }
    }
  }else{
    if ($('#password').val().localeCompare($('#password2').val()) == 0){
      return true;
    }else{
      alert('Las contraseñas deben coincidir');
      return false;
    }
  }
}

$('#ctrl-active').click(function(){
  if ($(this).prop('checked')){
    $('.bloqueado').attr('disabled', false);
  }else {
    $('.bloqueado').attr('disabled', true);
  }
});

$('tbody tr').on('click',function (){
  $('td').removeClass( "active-bio" );
  $('a').removeClass(' disabled');

  $(this).children('td').addClass( "active-bio" );
  //$('#jump').attr('href','2');
  //alert($('#jump').attr('onclick'));
  $('#id_activo').val($(this).children('input').val());
});



//Inizializando elementos
$('.modal').modal();
$('.button-collapse').sideNav();
