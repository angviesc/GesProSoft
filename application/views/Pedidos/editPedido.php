<div class="container">
  <?= form_open('Sistemactrl/previsualizarPedido','',$editPedido['sed'])?>

  <h4>Nuevo pedido</h4>

  <div class="input-field">
    <input type="text" name="nombre_pedido" id="nombre_pedido" value="<?=$editPedido['nombre_pedido']?>" required>
    <label for="nombre_pedido">Folio de seguimiento</label>
  </div>

  <div class="input-field" >
    <select name="id_proveedor">
      <?=$selectProv?>
    </select>
    <label >Proveedor:</label>
  </div>

  <div class="input-field">
    <input type="text" class="datepicker" data-value = "<?=$editPedido['fecha_llegada_submit']?>" name="fecha_llegada" id="fecha_llegada" required>
    <label for="fecha_llegada" name="test">Fecha estimada de recibo</label>
  </div>

  <h5>Articulos</h5>
  <table class="bordered highlight" id="tabla-dinamica">
    <thead>
      <tr>
        <th width = "30%">Articulo(Codigo)</th>
        <th width = "30%">Cantidad</th>
        <th width = "15%">Valor Unitario</th>
        <th width = "15%">Total</th>
      </tr>
    </thead>
    <tbody>
        <?php $x = 0;
        foreach ($editPedido['selectArt'] as $articulo){ ?>
          <tr >
            <td>
              <select class="selectArtMul" name="id_articulo[]">
                <?=$articulo?>
              </select>
            </td>
            <td><input type="number" name="cantidad[]" value="<?=$editPedido['cantidad'][$x]?>" min="0" class="cant-compra"></td>
            <td>$<?=$editPedido['costo_venta'][$x]?></td>
            <td>$<?=$editPedido['total'][$x]?></td>
          </tr>
        <?php
        $x++;
        } ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="5" class="right-align">
          <button type="button" class="waves-effect waves-light btn blue-grey darken-3" name="btn-add-ped" id="btn-add-ped">Añadir<i class="material-icons right">add</i></button>
          <a href="#" class="waves-effect waves-light btn blue-grey darken-3 disabled delete-renglon" name="btn-delete-area" id="btn-delete-inv">Eliminar<i class="material-icons right">delete</i></a>
        </td>
      </tr>
    </tfoot>
  </table>

  <h5>Total:</h5>

  <div class="row">
    <?= form_submit('submitGua','Previsualizar Pedido','class="col s6 btn waves-effect green darken-3"')?>
    <button type="button" name="button" class="col s6 btn waves-effect red lighten-1" onclick="cerrarVentana()">Cancelar</button>
  </div>
  <?= form_close()?>
</div>
<input type="hidden" name="site_url" id="site_url" value="<?=site_url()?>">
<input type="hidden" name="drop_art" id="drop_art" value='<?=$selectArt?>'>
