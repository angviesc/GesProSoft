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
    $('#btn-add-inv').addClass(' disabled');
    $('.contador_inv').attr('max',1);
  }else {
    $('.bloqueado').attr('disabled', true);
    $('#btn-add-inv').removeClass(' disabled');
    $('.contador_inv').removeAttr('max');
  }
  $('select').material_select();
});

$('tbody').on('click','tr',function (){
  //alert()

  $('td').removeClass( "active-bio" );
  $('a').removeClass(' disabled');

  if ($(this).children('input[name=id_tipo]').val() == 1){
    $('#eliminarBio').addClass('disabled');
  }

  $(this).children('td').addClass( "active-bio" );

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

  if ($('.input-tabla').length == $('#tabla-dinamica tbody tr').length) {
    $('#tabla-dinamica tbody ').append('<tr><td class="reglon-editable">'+
    '<input type="text" name="areas[]" class="input-tabla" style="margin-bottom: 1px; height: 1rem; " value="">'+
    '</td></tr>');
  }else {
    $('#tabla-dinamica tbody tr td').eq($('.input-tabla').length).append('<input type="text" name="areas[]" class="input-tabla" style="margin-bottom: 1px; height: 1rem; " value="">');
  }

});

$('#btn-elinar-area').click(function(){
  $('#tabla-dinamica').append('<input type="hidden" name="id_area_delete[]" value="'+$('#tabla-dinamica tbody tr').eq($('#tabla-dinamica tbody tr .active-bio').parent('tr').index()).children('input').val()+'" />')
  $('#tabla-dinamica tbody tr').eq($('#tabla-dinamica tbody tr .active-bio').parent('tr').index()).remove();
});

$('#btn-add-area').click(function(){
  $('#tabla-dinamica tbody ').append('<tr><td class="reglon-editable">'+
  '<input type="text" name="areas[]" class="input-tabla" style="margin-bottom: 1px; height: 1rem; " value="">'+
  '</td></tr>');
});

$('#btn-edit-area').click(function(){
  $renglon = $('#tabla-dinamica tbody tr').eq($('#tabla-dinamica tbody tr .active-bio').parent('tr').index());

  $renglon.children('input').attr('name','id_area_edit[]');
  $renglon.children('td').html('<input type="text" name="area_editada[]" class="input-tabla" style="margin-bottom: 1px; height: 1rem; " value="'+$renglon.children('td').text()+'">')
});

$('#btn-add-inv').click(function(){

  $('#tabla-dinamica tbody ').append('<tr><td class="reglon-alineado">'
  +'<div class="input-field">'
  +'<select name="id_almacen[]">'
  +$('#almacenesSelect').val()
  +'</select>'
  +'<label>Proveedores:</label>'
  +'</div></td>'
  +'<td class="reglon-alineado"><input type="number" class="contador_inv"  name="cantidad[]" min=0></td></tr>');

  $('select').material_select();
});


$('#tb_inventario').on('click','tr',function (){

  $('td').removeClass( "active-bio" );
  $('a').removeClass(' disabled');

  $(this).children('td').addClass( "active-bio" );
  if ($('#tabla-dinamica tbody tr .active-bio').parent('tr').index() == 0){
    $('#btn-delete-inv').addClass('disabled');
  }

  //$('#id_activo').val($(this).children('input').val());
});

$('.delete-renglon').click(function(){
  $('#tabla-dinamica').append('<input type="hidden" name="id_area_delete[]" value="'+$('#tabla-dinamica tbody tr').eq($('#tabla-dinamica tbody tr .active-bio').parent('tr').index()).children('input').val()+'" />')
  $('#tabla-dinamica tbody tr').eq($('#tabla-dinamica tbody tr .active-bio').parent('tr').index()).remove();
});

/*
$('input').on('change','.contador_inv',function(){
  alert($(this).val());
  var total = 0;
  $('.contador_inv').each(function(){
    total += parseInt($(this).val());
  });
  $('#totalPzas').text(total);
});
*/
//Inizializando elementos
$('.modal').modal();
$('.button-collapse').sideNav();
$('select').material_select();
$('ul.tabs').tabs();

$('.datepicker').pickadate({
  formatSubmit: 'yyyy-mm-dd',
	labelMonthNext: 'Siguiente mes',
	labelMonthPrev: 'Mes anterior',
	labelMonthSelect: 'Selecciona un mes',
	labelYearSelect: 'Selecciona un año',
	monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
	monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
	weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado' ],
	weekdaysShort: [ 'Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa' ],
	weekdaysLetter: [ 'D', 'L', 'M', 'X', 'J', 'V', 'S' ],
	today: 'Hoy',
	clear: 'Limpiar',
	close: 'Cerrar'
});
