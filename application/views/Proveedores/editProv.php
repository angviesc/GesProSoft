<div class="container">  
  <?= form_open('Sistemactrl/actualizaProv','',array('id' => $proveedor[0]['id'] ))?>
  <h4>Editar proveedor</h4>
  <div class="input-field">
    <input type="text" name="nombre_proveedor" id="nombre_proveedor" value="<?=$proveedor[0]['nombre_proveedor']?>" required>
    <label for="nombre_proveedor">Nombre:</label>
  </div>

  <h5>Datos de contacto</h5>

  <div class="input-field">
    <input type="text" name="nombre" id="nombre" value="<?=$proveedor[0]['nombre']?>">
    <label for="nombre">Nombre:</label>
  </div>

  <div class="input-field">
    <input type="text" name="apellidop" id="apellidop" value="<?=$proveedor[0]['apellidop']?>">
    <label for="apellidop">Apellido paterno:</label>
  </div>
  <div class="input-field">
    <input type="text" name="apellidom" id="apellidom" value="<?=$proveedor[0]['apellidom']?>" >
    <label for="apellidom">Apellido materno:</label>
  </div>
  <div class="input-field">
    <input type="text" name="telefono" id="telefono" value="<?=$proveedor[0]['telefono']?>" >
    <label for="telefono">Telefono:</label>
  </div>
  <div class="input-field">
    <input type="text" name="tel_atl" id="tel_atl" value="<?=$proveedor[0]['tel_atl']?>" >
    <label for="tel_atl">Telefono alterno:</label>
  </div>
  <div class="input-field">
    <input type="text" name="colonia" id="colonia" value="<?=$proveedor[0]['colonia']?>" >
    <label for="colonia">Colonia:</label>
  </div>
  <div class="input-field">
    <input type="text" name="calle" id="calle" value="<?=$proveedor[0]['calle']?>">
    <label for="calle">Calle:</label>
  </div>
  <div class="input-field">
    <input type="text" name="cod_pos" id="cod_pos" value="<?=$proveedor[0]['cod_pos']?>" >
    <label for="cod_pos">Codigo Postal:</label>
  </div>
  <div class="input-field">
    <input type="email" name="email" id="email" value="<?=$proveedor[0]['email']?>" >
    <label for="email">Correo electronico:</label>
  </div>
  <div class="row">
    <?= form_submit('submitGua','Guardar','class="col s6 btn waves-effect green darken-3"')?>
    <button type="button" name="button" class="col s6 btn waves-effect red lighten-1" onclick="cerrarVentana()">Cancelar</button>
  </div>
  <?= form_close()?>
</div>
