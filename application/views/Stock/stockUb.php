<?php //echo '<pre>';print_r($stock);
 ?>
<table>
  <thead>
    <tr>
      <th>Codigo</th>
      <th>Articulo</th>
      <th>Descripción</th>
      <th>Ubicación</th>
      <th>Cantidad</th>
    </tr>
  </thead>
  <tbody class="moveStock">
    <?php foreach ($stock as $articulo) { ?>
      <tr>
        <input type="hidden" name="id_stock[]" value="<?=$articulo['id']?>">
        <td><?=$articulo['codigo'] ?></td>
        <td><?=$articulo['nombre'] ?></td>
        <td><?=$articulo['descripcion'] ?></td>
        <td><?=$articulo['almacen'] ?></td>
        <td><?=$articulo['cantidad'] ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<script src ="<?= base_url('assets/js/dinamicScripts.js') ?>"> </script>
