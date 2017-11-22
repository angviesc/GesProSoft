<div class="container">

  <h4>Folio: <?=$pedido['folio'] ?></h4>

  <div class="input-field">
    <input type="text" name="nombre_proveedor" id="nombre_proveedor" value="<?=$pedido['proveedor']?>" disabled>
    <label for="nombre_proveedor">Proveedor</label>
  </div>

  <div class="input-field">
    <input type="text" class="datepicker" data-value="<?=$pedido['fecha_emision']?>" name="fecha_llegada" id="fecha_llegada" disabled>
    <label for="fecha_llegada" name="test">Fecha de emisión</label>
  </div>

  <div class="input-field">
    <input type="text" class="datepicker" data-value="<?=$pedido['fecha_llegada']?>" name="fecha_llegada" id="fecha_llegada" disabled>
    <label for="fecha_llegada" name="test">Fecha estimada de recibo</label>
  </div>

  <h5>Articulos</h5>
  <table class="bordered highlight" id="tabla-dinamica">
    <thead>
      <tr>
        <th width = "10%">No.</th>
        <th width = "40%">Articulo(Codigo)</th>
        <th width = "30%">cantida</th>
        <th width = "10%">Valor unitario</th>
        <th width = "10%">Total</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $x=0;
        $total = 0;
        foreach ($articulos_pedidos as $articulo) { ?>
          <tr >
            <td><?=++$x?></td>
            <td><?=$articulo['nombre'].'('.$articulo['codigo'].')' ?></td>
            <td><?=$articulo['cantidad']?></td>
            <td>$<?=$articulo['precio_unitario']?></td>
            <td>$<?=$articulo['precio_unitario']*$articulo['cantidad']?></td>
            <?php  $total += $articulo['precio_unitario']*$articulo['cantidad'];?>
          </tr>
        <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4" class="right-align">Total: $ </td>
        <td >
          <?=$total ?>
        </td>
      </tr>
    </tfoot>
  </table>



  <div class="row">

  </div>

</div>
<input type="hidden" name="site_url" id="site_url" value="<?=site_url()?>">
<input type="hidden" name="drop_art" id="drop_art" value='<?=$selectArt?>'>
