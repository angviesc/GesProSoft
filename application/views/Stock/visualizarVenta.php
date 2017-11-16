<div class="container">
  <?= form_open('Sistemactrl/insertarVenta')?>

  <h4>Folio:<?=$venta['nombre_venta']?></h4>
  <input type="hidden" name="nombre_venta" id="nombre_venta" value="<?=$venta['nombre_venta']?>">
  <input type="hidden" name="id_cliente" id="id_cliente" value="<?=$venta['id_cliente']?>">
  <input type="hidden" name="nota" id="nota" value="<?=$venta['nota']?>">

  <div class="input-field">
    <input type="text" value="<?=$venta['nombre_cliente']?>" name="input1" id="input1" disabled>
    <label for="input1" name="test">Cliente: </label>
  </div>

  <div class="input-field">
    <input type="text" class="datepicker" data-value="<?=$venta['fecha_venta']?>" name="fecha_venta" id="fecha_venta" disabled>
    <label for="fecha_venta" name="test">Fecha de venta</label>
  </div>

  <h5>Articulos</h5>
  <table class="bordered highlight" id="tabla-dinamica">
    <thead>
      <tr>
        <th width = "30%">Codigo(Articulo)</th>
        <th width = "30%">Ubicación</th>
        <th width = "15%">Cant. Venta</th>
        <th width = "15%">Precio</th>
        <th width = "10%">Cant. Stock</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($articulos as $articulo){ ?>
      <tr>
        <input type="hidden" name="id_articulo[]" value="<?=$articulo['id_articulo']?>">
        <input type="hidden" name="id_almacen[]" value="<?=$articulo['id_almacen']?>">
        <input type="hidden" name="costo_venta[]" value="<?=$articulo['costo_venta']?>">
        <input type="hidden" name="cantidad_stock[]" value="<?=$articulo['cantidad']?>">

        <input type="hidden" name="id_stock[]" value="<?=$articulo['id_stock']?>">
        <input type="hidden" name="cantidad_venta[]" value="<?=$articulo['venta']?>">
        <td><?=$articulo['codigo'].'('.$articulo['nombre'].')'?></td>
        <td><?=$articulo['almacen']?></td>
        <td><?=$articulo['venta']?></td>
        <td>$<?=$articulo['costo_venta'] ?></td>
        <td><?=$articulo['cantidad']?></td>
      </tr>
    <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="5" class="right-align">
          <a href="#" class="waves-effect waves-light btn blue-grey darken-3 disabled delete-renglon" name="btn-delete-area" id="btn-delete-inv">Eliminar<i class="material-icons right">delete</i></a>
        </td>
      </tr>
    </tfoot>
  </table>

  <div class="input-field">
    <textarea class="materialize-textarea" rows="4" cols="80" disabled><?=str_replace('<br />','',$venta['nota'])?></textarea>
    <label for="nota">Nota:</label>
  </div>

  <div class="row">
    <?= form_submit('submitGua','Guardar','class="col s6 btn waves-effect green darken-3"')?>
    <?= form_submit('submitEdit','Editar','class="col s6 btn waves-effect green darken-3"')?>
  </div>
  <?= form_close()?>
</div>
<input type="hidden" name="site_url" id="site_url" value="<?=site_url()?>">
<input type="hidden" name="site_url" id="site_url" value="<?=site_url()?>">
