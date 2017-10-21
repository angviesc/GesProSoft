<div class="container">
  <?= form_open('Sistemactrl/insertarBio')?>
  <h4>Nuevo Biomédico</h4>
  <div class="input-field">
    <input type="text" name="nombre" id="nombre" required>
    <label for="nombre">Nombre:</label>
  </div>
  <div class="input-field">
    <input type="text" name="apellidop" id="apellidop" required>
    <label for="apellidop">Apellido paterno:</label>
  </div>
  <div class="input-field">
    <input type="text" name="apellidom" id="apellidom" >
    <label for="apellidom">Apellido materno:</label>
  </div>
  <div class="input-field">
    <input type="text" name="tel" id="tel" required>
    <label for="tel">Telefono:</label>
  </div>
  <div class="input-field">
    <input type="text" name="tel_atl" id="tel_atl" >
    <label for="tel_atl">Telefono alterno:</label>
  </div>
  <div class="input-field">
    <input type="text" name="colonia" id="colonia" required>
    <label for="colonia">Colonia:</label>
  </div>
  <div class="input-field">
    <input type="text" name="calle" id="calle" required>
    <label for="calle">Call:e</label>
  </div>
  <div class="input-field">
    <input type="text" name="cod_pos" id="cod_pos" required>
    <label for="cod_pos">Codigo Postal:</label>
  </div>
  <div class="input-field">
    <input type="email" name="email" id="email" required>
    <label for="email">Correo electronico:</label>
  </div>
  <div class="input-field">
    <input type="text" name="usuario" id="usuario" required>
    <label for="usuario">Usuario</label>
  </div>
  <div class="input-field">
    <input type="password" name="password" id="password" required>
    <label for="password">Contraseña</label>
  </div>
  <div class="input-field">
    <input type="password" name="password" id="password" required>
    <label for="password">Confirmar Contraseña</label>
  </div>
  <div class="row">
    <?= form_submit('submitAcc','Guardar','class="col s12 btn btn-large waves-effect blue accent-4"')?>
  </div>
  <?= form_close()?>
</div>
