<div class="container">
  <?= form_open('Sistemactrl/validarAcceso')?>
  <div class="input-field">
    <input type="text" name="usuario" id="usuario" required>
    <label for="usuario">Usuario</label>
  </div>
  <div class="input-field">
    <input type="password" name="password" id="password" required>
    <label for="password">Contraseña</label>
  </div>
  <div class="row">
    <?= form_submit('submitAcc','Acceder','class="col s12 btn btn-large waves-effect blue accent-4"')?>
  </div>
  <?= form_close()?>  
</div>
