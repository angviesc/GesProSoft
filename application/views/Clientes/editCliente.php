<div class="container">
  <?= form_open('Sistemactrl/actualizarCliente','',array('id' => $cliente[0]['id']))?>
  <h4>Editar cliente</h4>
  <div class="input-field">
    <input type="text" name="nombre_cliente" id="nombre_cliente" value="<?=$cliente[0]['nombre_cliente'] ?>" required>
    <label for="nombre_cliente">Nombre:</label>
  </div>

  <h5>Datos de contacto</h5>

  <div class="input-field">
    <input type="text" name="nombre" id="nombre" value="<?=$cliente[0]['nombre'] ?>">
    <label for="nombre">Nombre:</label>
  </div>

  <div class="input-field">
    <input type="text" name="apellidop" id="apellidop" value="<?=$cliente[0]['apellidop'] ?>">
    <label for="apellidop">Apellido paterno:</label>
  </div>

  <div class="input-field">
    <input type="text" name="apellidom" id="apellidom" value="<?=$cliente[0]['apellidom'] ?>" >
    <label for="apellidom">Apellido materno:</label>
  </div>

  <div class="input-field">
    <input type="text" name="telefono" id="telefono" value="<?=$cliente[0]['telefono'] ?>" >
    <label for="telefono">Telefono:</label>
  </div>

  <div class="input-field">
    <input type="text" name="direccion_fac" id="direccion_fac" value="<?=$cliente[0]['direccion_fac'] ?>" >
    <label for="direccion_fac">Direccion de facturacion:</label>
  </div>

  <div class="input-field">
    <input type="text" name="pais" id="pais" value="<?=$cliente[0]['pais'] ?>" >
    <label for="pais">Pais:</label>
  </div>

  <div class="input-field">
    <input type="text" name="estado" id="estado" value="<?=$cliente[0]['estado'] ?>" >
    <label for="estado">Estado:</label>
  </div>

  <div class="input-field">
    <input type="text" name="ciudad" id="ciudad" value="<?=$cliente[0]['ciudad'] ?>" >
    <label for="ciudad">Ciudad:</label>
  </div>

  <div class="input-field">
    <input type="text" name="cod_pos" id="cod_pos" value="<?=$cliente[0]['cod_pos'] ?>" >
    <label for="cod_pos">Codigo Postal:</label>
  </div>

  <div class="input-field">
    <input type="email" name="correo" id="correo" value="<?=$cliente[0]['correo'] ?>" >
    <label for="correo">Correo electronico:</label>
  </div>
  <div class="row">
    <?= form_submit('submitGua','Guardar','class="col s6 btn waves-effect green darken-3"')?>
    <button type="button" name="button" class="col s6 btn waves-effect red lighten-1" onclick="cerrarVentana()">Cancelar</button>
  </div>
  <?= form_close()?>
</div>
