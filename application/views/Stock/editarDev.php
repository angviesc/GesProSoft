<div class="container">
  <?= form_open('Sistemactrl/previsualizarDevolucion')?>

  <h4>Devolver Stock</h4>

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
      <?php for ($i=0; $i < count($editVenta['selectArt']) ; $i++) { ?>
        <tr >
          <td>
            <select class="selectArt" name="id_articulo[]">
              <?=$editVenta['selectArt'][$i]?>
            </select>
          </td>
          <td>
            <select class="selectAlm" name="id_almacen[]">
              <?=$editVenta['selectAlm'][$i]?>
            </select>
          </td>
          <td><input type="number" name="cantidad[]" min = "0" max ="<?=$editVenta['cantidad_stock'][$i]?>" value="<?=$editVenta['cantidad_venta'][$i]?>"></td>
          <td>$<?=$editVenta['costo_venta'][$i]?></td>
          <td><?=$editVenta['cantidad_stock'][$i]?></td>
        </tr>
    <?php } ?>
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

  <div class="row">
    <?= form_submit('submitGua','Guardar','class="col s6 btn waves-effect green darken-3"')?>
    <button type="button" name="button" class="col s6 btn waves-effect red lighten-1" onclick="cerrarVentana()">Cancelar</button>
  </div>
  <?= form_close()?>
</div>


<input type="hidden" name="site_url" id="site_url" value="<?=site_url()?>">
<input type="hidden" name="drop_art" id="drop_art" value='<?=$selectArt?>'>
