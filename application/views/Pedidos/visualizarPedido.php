<div class="container">
  <?= form_open('Sistemactrl/insertarPedido','',$sed)?>
  <h4>Folio: <?=$pedido['nombre_pedido'] ?></h4>
  <input type="hidden" name="nombre_pedido" id="nombre_pedido" value="<?=$pedido['nombre_pedido']?>">
  <input type="hidden" name="id_proveedor" id="id_proveedor" value="<?=$pedido['id_proveedor']?>">

  <div class="input-field">
    <input type="text" name="nombre_proveedor" id="nombre_proveedor" value="<?=$proveedor?>" disabled>
    <label for="nombre_proveedor">Proveedor</label>
  </div>

  <div class="input-field">
    <input type="text" class="datepicker" data-value="<?=$pedido['fecha_llegada']?>" name="fecha_llegada" id="fecha_llegada" disabled>
    <label for="fecha_llegada" name="test">Fecha estimada de recibo</label>
  </div>

  <h5>Articulos</h5>
  <table class="bordered highlight" id="tabla-dinamica">
    <thead>
      <tr>
        <th width = "55%">Articulo(Codigo)</th>
        <th width = "15%">Cantidad</th>
        <th width = "15%">Valor Unitario</th>
        <th width = "15%">Total</th>
      </tr>
    </thead>
    <tbody>
        <?php
        foreach ($articulos_pedidos as $articulo) { ?>
          <tr >
            <input type="hidden" name="id_articulo[]" value="<?=$articulo['id_articulo']?>">
            <input type="hidden" name="cantidad[]" value="<?=$articulo['cantidad']?>">
            <input type="hidden" name="costo_venta[]" value="<?=$articulo['precio_unitario']?>">
            <input type="hidden" name="total[]" value="<?=$articulo['cantidad']*$articulo['precio_unitario']?>">

            <td><?=$articulo['nombre'].'('.$articulo['codigo'].')' ?></td>
            <td><?=$articulo['cantidad']?></td>
            <td>$<?=$articulo['precio_unitario']?></td>
            <td><?=$articulo['cantidad']*$articulo['precio_unitario']?></td>
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

  <h5>Total:</h5>

  <div class="row">
    <?= form_submit('submitGua','Guardar','class="col s6 btn waves-effect green darken-3"')?>
    <?= form_submit('submitEdit','Editar','class="col s6 btn waves-effect green darken-3"')?>
  </div>
  <?= form_close()?>
</div>
<input type="hidden" name="site_url" id="site_url" value="<?=site_url()?>">
<input type="hidden" name="drop_art" id="drop_art" value='<?=$selectArt?>'>
