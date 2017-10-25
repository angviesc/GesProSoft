<div class="container">
  <?= form_open('Sistemactrl/actualizarBio','name = "editarBio" onsubmit="return validaBio(this);"',array('id_empleado' => $biomedico['id']))?>
  <h4>Nuevo Biomédico</h4>
  <div class="input-field">
    <input type="text" name="nombre" id="nombre" value="<?=$biomedico['nombre']?>" required>
    <label for="nombre">Nombre:</label>
  </div>
  <div class="input-field">
    <input type="text" name="apellidop" id="apellidop" value="<?=$biomedico['apellidop']?>" required>
    <label for="apellidop">Apellido paterno:</label>
  </div>
  <div class="input-field">
    <input type="text" name="apellidom" id="apellidom"  value="<?=$biomedico['apellidom']?>">
    <label for="apellidom">Apellido materno:</label>
  </div>
  <div class="input-field">
    <input type="text" name="tel" id="tel" value="<?=$biomedico['tel']?>" required>
    <label for="tel">Telefono:</label>
  </div>
  <div class="input-field">
    <input type="text" name="tel_atl" id="tel_atl" value="<?=$biomedico['tel_atl']?>">
    <label for="tel_atl">Telefono alterno:</label>
  </div>
  <div class="input-field">
    <input type="text" name="colonia" id="colonia" value="<?=$biomedico['colonia']?>" required>
    <label for="colonia">Colonia:</label>
  </div>
  <div class="input-field">
    <input type="text" name="calle" id="calle" value="<?=$biomedico['calle']?>" required>
    <label for="calle">Calle:</label>
  </div>
  <div class="input-field">
    <input type="text" name="cod_pos" id="cod_pos" value="<?=$biomedico['cod_pos']?>" required>
    <label for="cod_pos">Codigo Postal:</label>
  </div>
  <div class="input-field">
    <input type="email" name="email" id="email" value="<?=$biomedico['email']?>" required>
    <label for="email">Correo electronico:</label>
  </div>
  <div class="switch">
    ¿Editar datos de inicio de sesion?
    <label>
      No
      <input type="checkbox" id="ctrl-active">
      <span class="lever"></span>
      Sí
    </label>
  </div>
  <!--
-->
  <div class="input-field">
    <input type="text" disabled name="usuario" id="usuario" value="<?=$biomedico['usuario']?>" required>
    <label for="usuario">Usuario</label>
  </div>
  <div class="input-field">
    <input type="password" disabled class="bloqueado" name="password" id="password" required>
    <label for="password">Contraseña</label>
  </div>
  <div class="input-field">
    <input type="password" disabled class="bloqueado" name="password2" id="password2" required>
    <label for="password2">Confirmar Contraseña</label>
  </div>
  <div class="row">
    <?= form_submit('submitGua','Guardar','class="col s6 btn btn-large waves-effect blue accent-4"')?>
    <button type="button" name="button" class="col s6 btn btn-large waves-effect blue accent-4" onclick="cerrarVentana()">Cancelar</button>
  </div>
  <?= form_close()?>
</div>
