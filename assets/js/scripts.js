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

$('tbody').on('click','tr',function (){

  $('td').removeClass( "active-bio" );

  if ($(this).children('input[name=status]').val() == 0)
    $('a').removeClass(' disabled');
  else{
    $('#btn-recibe').addClass('disabled');
    $('#btn-delete-pedido').addClass('disabled');
  }

  if ($(this).children('input[name=id_tipo]').val() == 1){
    $('#eliminarBio').addClass('disabled');
  }

  $(this).children('td').addClass( "active-bio" );

  $('#id_activo').val($(this).children('input').val());
});

$('.delete-renglon').click(function(){
  $('#tabla-dinamica').append('<input type="hidden" name="id_area_delete[]" value="'+$('#tabla-dinamica tbody tr').eq($('#tabla-dinamica tbody tr .active-bio').parent('tr').index()).children('input').val()+'" />')
  $('#tabla-dinamica tbody tr').eq($('#tabla-dinamica tbody tr .active-bio').parent('tr').index()).remove();
});

//$('.selecArt').

$('tbody').on('change','.contador_inv',function(){
  var total = 0;
  $('.contador_inv').each(function(){
    total += parseInt($(this).val());
  });
  $('#totalPzas').text(total);
});

$('#btn-add-art').click(function(){
  $('#tabla-dinamica tbody ').append('<tr><td><select class="selectArt" name="id_articulo[]">'
    +$('#drop_art').val()
    +'</select></td><td></td><td></td><td></td><td></td></tr>');
  $('select').material_select();
});

$('tbody').on('change','.selectArt',function(){
  if ($(this).val() != ''){
  var index = $(this).parent().parent().parent().index();
  var id_art = $(this).val();

    var php = $('#site_url').val()+'/Sistemactrl/cargarUb/';
    $.post( php, {id_art : id_art},
      function(data){
        $('#tabla-dinamica tbody').children('tr').eq(index).children('td').eq(1).html(data);
        $('select').material_select();
      }
    );

    $('#tabla-dinamica tbody').children('tr').eq(index).children('td').eq(2).html('');
    $('#tabla-dinamica tbody').children('tr').eq(index).children('td').eq(3).html('');
    $('#tabla-dinamica tbody').children('tr').eq(index).children('td').eq(4).html('');


//$('#tabla-dinamica tbody').children('tr').eq(index).children('td').eq(1).text('Aqui');
  //.children('td').text('Aqui');
  }
});

$('tbody').on('change','.selectAlm',function(){
  if ($(this).val() != ''){
  var index = $(this).parent().parent().parent().index();
  var id_alm = $(this).val();
  var id_art = $('#tabla-dinamica tbody').children('tr').eq(index).children('td').find('.selectArt select').val();

  var php = $('#site_url').val()+'/Sistemactrl/cargarPrecio/';
  $.post( php, {id_art : id_art},
    function(data){
      $('#tabla-dinamica tbody').children('tr').eq(index).children('td').eq(3).html(data);
    }
  );

        var php = $('#site_url').val()+'/Sistemactrl/cargarExistencias/';
    $.post( php, {id_art : id_art, id_alm : id_alm},
      function(data){
        $('#tabla-dinamica tbody').children('tr').eq(index).children('td').eq(4).html(data);
        $('#tabla-dinamica tbody').children('tr').eq(index).children('td').eq(2).html('<input type="number" name="cantidad[]" min = "0" max = "'+data+'" >');
      }
    );
  }
});

$('#selectStock').change(function(){
  var id_alm = $(this).val();

  var php = $('#site_url').val()+'/Sistemactrl/cargarStock/';
  $.post( php, {id_alm : id_alm},
    function(data){
      $('#stockOrigen').html(data);
    }
  );
});

$('#btn-stock').click(function(){
  var index = $('tbody tr .active-bio').parent('tr').index();
  var id_stock = $('tbody tr').eq(index).children('input').val();
  var cantidad = $('#cant-trans').val();
  var alm_dest = $('#alm_dest').val();

  if (alm_dest != null) {
    var php = $('#site_url').val()+'/Sistemactrl/updateStock/';
    $.post( php, {id_stock : id_stock, cantidad : cantidad, alm_dest : alm_dest},
      function(data){
        //alert(data)
      }
    );

    var id_alm = $('#selectStock').val();

    var php = $('#site_url').val()+'/Sistemactrl/cargarStock/';
    $.post( php, {id_alm : id_alm},
      function(data){
        $('#stockOrigen').html(data);
      }
    );
  }

});

$('#btn-add-art').click(function(){
  $('#tabla-dinamica tbody ').append('<tr><td><select class="selectArt" name="id_articulo[]">'
    +$('#drop_art').val()
    +'</select></td><td></td><td></td><td></td><td></td></tr>');
  $('select').material_select();
});

$('#btn-add-ped').click(function(){
  $('#tabla-dinamica tbody ').append('<tr><td><select class="selectArtMul" name="id_articulo[]">'
    +$('#drop_art').val()
    +'</select></td>'
    +'<td><input type="number" name="cantidad[]" min="0" class="cant-compra"></td>'
    +'<td></td><td></td></tr>');
  $('select').material_select();
});

$('#btn-add-pedido').click(function(){
  $('#tabla-dinamica tbody ').append('<tr ><td><select class="selectArtMul" name="id_articulo[]">'
  +$('#drop_art').val()
  +'</select></td><td><select class="selectAlmSto" name="id_almacen[]">'
  +$('#drop_alm').val()
  +'</select></td><td></td><td></td><td></td></tr>');
  $('select').material_select();
});

$('tbody').on('change','.selectArtMul',function(){
  if ($(this).val() != ''){
  var index = $(this).parent().parent().parent().index();
  var id_art = $(this).val();

    var php = $('#site_url').val()+'/Sistemactrl/cargaPrecio/';
    $.post( php, {id_art : id_art},
      function(data){
        $('#tabla-dinamica tbody').children('tr').eq(index).children('td').eq(2).html(data);
      }
    );
    $('#tabla-dinamica tbody').children('tr').eq(index).children('td').eq(3).html('');
  }
});

$('tbody').on('change','.selectAlmSto',function(){
  if ($(this).val() != ''){
  var index = $(this).parent().parent().parent().index();
  var id_art = $('#tabla-dinamica tbody').children('tr').eq(index).children('td').find('.selectArtMul select').val();
  if (id_art != null) {
    var id_alm = $(this).val();

    var php = $('#site_url').val()+'/Sistemactrl/cargarExistencias/';
    $.post( php, {id_art : id_art, id_alm : id_alm},
      function(data){
        $('#tabla-dinamica tbody').children('tr').eq(index).children('td').eq(3).html('<input type="number" name="cantidad[]" min = "0" >');
        $('#tabla-dinamica tbody').children('tr').eq(index).children('td').eq(4).html(data);
      }
    );
  }
/*
  var php = $('#site_url').val()+'/Sistemactrl/cargarPrecio/';
  $.post( php, {id_art : id_art},
    function(data){
      $('#tabla-dinamica tbody').children('tr').eq(index).children('td').eq(3).html(data);
    }
  );
*/
  }
});

$('tbody').on('change','.cant-compra',function(){
  var index = $(this).parent().parent().index();
  var cant = $(this).val();
  var precio = $('#tabla-dinamica tbody').children('tr').eq(index).children('td').eq(2).text();

  $('#tabla-dinamica tbody').children('tr').eq(index).children('td').eq(3).text(cant*precio.replace("$", ""));
});

$('#btn-recibe').click(function(){
  var id_pedido = $("#id_activo").val();
  var php = $('#link').val()+'/recibirPedido/';
  $.post( php, {id_pedido : id_pedido},
    function(data){
      location.reload();
      //window.opener.document.location="verPedidos/INSERT_OK"
    }
  );
});



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
