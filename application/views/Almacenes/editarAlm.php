
<div class="container">
  <?= form_open('Sistemactrl/actualizarAlm','',array('id' =>$almacen[0]['id'] ))?>
  <h4>Nuevo Almacen</h4>
  <div class="input-field">
    <input type="text" name="nombre" id="nombre" value="<?=$almacen[0]['nombre']?>" required>
    <label for="nombre">Nombre:</label>
  </div>

  <div class="input-field">
    <textarea name="ubicacion" id="ubicacion" class="materialize-textarea" rows="4" cols="40" ><?=str_replace('<br />','',$almacen[0]['ubicacion'])?></textarea>

    <label for="ubicacion">Ubicacion:</label>
  </div>

  <div class="row">
    <?= form_submit('submitGua','Guardar','class="col s6 btn waves-effect green darken-3"')?>
    <button type="button" name="button" class="col s6 btn waves-effect red lighten-1" onclick="cerrarVentana()">Cancelar</button>
  </div>
  <?= form_close()?>
</div>
