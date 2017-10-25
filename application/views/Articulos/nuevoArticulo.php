<div class="container">
  <?= form_open('Sistemactrl/insertArticulo')?>
  <h4>Nuevo Artículo</h4>
  <div class="input-field">
    <input type="text" name="codigo" id="codigo" required>
    <label for="codigo">Código:</label>
  </div>
  <div class="input-field">
    <input type="text" name="nombre" id="nombre" required>
    <label for="nombre">Nombre:</label>
  </div>
  <div class="input-field">
    <textarea name="descripcion" id="descripcion" class="materialize-textarea" rows="4" cols="80"></textarea>
    <label for="descripcion">Descripcion:</label>
  </div>
  <div class="input-field">
    <input type="text" name="tel" id="tel" required>
    <label for="tel">Departamento:</label>
  </div>
  <div class="input-field">
    <input type="text" name="tel_atl" id="tel_atl" >
    <label for="tel_atl">Area:</label>
  </div>
  <div class="input-field">
    <input type="number" step="0.01" min="0" name="costo_compra" id="costo_compra" required>
    <label for="costo_compra">Costo de compra:</label>
  </div>
  <div class="input-field">
    <input type="number" step="0.01" min="0" name="costo_venta" id="costo_venta" required>
    <label for="costo_venta">Costo de venta:</label>
  </div>
  <div class="input-field">
    <textarea name="nota" id="nota" class="materialize-textarea" rows="4" cols="80"></textarea>
    <label for="nota">Nota:</label>
  </div>
  <div class="switch">
    Equipo unico
    <label>
      No
      <input type="checkbox" name = "update_usuario" id="ctrl-active">
      <span class="lever"></span>
      Sí
    </label>
  </div>
  <div class="input-field">
    <input type="text" disabled class="bloqueado" name="marca" id="marca" required>
    <label for="marca">Marca:</label>
  </div>
  <div class="input-field">
    <input type="email" disabled class="bloqueado" name="modelo" id="modelo" required>
    <label for="modelo">Modelo:</label>
  </div>
  <div class="input-field">
    <input type="text" disabled class="bloqueado" name="serie" id="serie" required>
    <label for="serie">Serie</label>
  </div>
  <div class="row">
    <?= form_submit('submitGua','Guardar','class="col s6 btn waves-effect green darken-3"')?>
    <button type="button" name="button" class="col s6 btn waves-effect red lighten-1" onclick="cerrarVentana()">Cancelar</button>
  </div>
  <?= form_close()?>
</div>
