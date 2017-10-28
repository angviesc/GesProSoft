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
  if ($(this).children('input[name=id_tipo]').val() == 1){
    $('#eliminarBio').addClass('disabled');
  }

  $(this).children('td').addClass( "active-bio" );
  //$('#jump').attr('href','2');
  //alert($('#jump').attr('onclick'));
  $('#id_activo').val($(this).children('input').val());
});

$('#id_departamento').change(function(){
  var idpto = $('#id_departamento').val();
  var php = $('#site_url').val()+'/Sistemactrl/consultaArea/'+idpto;
  $.post( php, {idpto : idpto},
    function(data){
      $("#select-area").html(data);
      $('select').material_select();
    }
  );
});

$('#addArea').click(function(){
  //alert($('#tabla-dinamica tbody tr').eq(0).html());
  if ($('.input-tabla').length == $('#tabla-dinamica tbody tr').length) {
    //alert($('#tabla-dinamica tbody').html());

    $('#tabla-dinamica tbody ').append('<tr><td class="reglon-editable">'+
    '<input type="text" name="areas[]" class="input-tabla" style="margin-bottom: 1px; height: 1rem; " value="">'+
    '</td></tr>');
  }else {
    $('#tabla-dinamica tbody tr td').eq($('.input-tabla').length).append('<input type="text" name="areas[]" class="input-tabla" style="margin-bottom: 1px; height: 1rem; " value="">');
  }
  //alert($('#tabla-dinamica tbody tr').length);

  //$('#tabla-dinamica').eq(0).append( "<b>Test</b>" );
});


//Inizializando elementos
$('.modal').modal();
$('.button-collapse').sideNav();
$('select').material_select();
$('ul.tabs').tabs();
