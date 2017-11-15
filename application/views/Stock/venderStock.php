<div class="container">
  <?= form_open('Sistemactrl/previsualizarVenta','',$sed)?>

  <h4>Vender Stock</h4>

  <div class="input-field">
    <input type="text" name="nombre_venta" id="nombre_venta" required>
    <label for="nombre_venta">Folio de seguimiento</label>
  </div>

  <div class="input-field" >
    <select name="id_cliente">
      <?=$selectCli?>
    </select>
    <label >Cliente:</label>
  </div>

  <div class="input-field">
    <input type="text" class="datepicker" name="fecha_venta" id="fecha_venta" required>
    <label for="fecha_venta" name="test">Fecha de venta</label>
  </div>

  <h5>Articulos</h5>
  <table class="bordered highlight" id="tabla-dinamica">
    <thead>
      <tr>
        <th width = "30%">Articulo(Codigo)</th>
        <th width = "30%">Ubicación</th>
        <th width = "15%">Cant. Venta</th>
        <th width = "15%">Precio</th>
        <th width = "10%">Cant. Stock</th>
      </tr>
    </thead>
    <tbody>
      <tr >
        <td>
          <select class="selectArt" name="id_articulo[]">
            <?=$selectArt?>
          </select>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="5" class="right-align">
          <button type="button" class="waves-effect waves-light btn blue-grey darken-3" name="btn-add-art" id="btn-add-art">Añadir<i class="material-icons right">add</i></button>
          <a href="#" class="waves-effect waves-light btn blue-grey darken-3 disabled delete-renglon" name="btn-delete-area" id="btn-delete-inv">Eliminar<i class="material-icons right">delete</i></a>
        </td>
      </tr>
    </tfoot>
  </table>

  <div class="input-field">
    <textarea name="nota" id="nota" class="materialize-textarea" rows="4" cols="80"></textarea>
    <label for="nota">Nota:</label>
  </div>

  <div class="row">
    <?= form_submit('submitGua','Previsualizar Venta','class="col s6 btn waves-effect green darken-3"')?>
    <button type="button" name="button" class="col s6 btn waves-effect red lighten-1" onclick="cerrarVentana()">Cancelar</button>
  </div>
  <?= form_close()?>
</div>
<input type="hidden" name="site_url" id="site_url" value="<?=site_url()?>">
<input type="hidden" name="drop_art" id="drop_art" value='<?=$selectArt?>'>
