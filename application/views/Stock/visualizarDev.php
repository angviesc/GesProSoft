<div class="container">
  <?= form_open('Sistemactrl/devStock')?>

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

  <div class="row">
    <?= form_submit('submitGua','Devolver','class="col s6 btn waves-effect green darken-3"')?>
    <?= form_submit('submitEdit','Editar','class="col s6 btn waves-effect green darken-3"')?>
  </div>
  <?= form_close()?>
</div>
<input type="hidden" name="site_url" id="site_url" value="<?=site_url()?>">
<input type="hidden" name="site_url" id="site_url" value="<?=site_url()?>">
