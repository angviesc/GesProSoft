<table  id="tabla_">
  <thead>
    <tr>
      <th>NO.</th>
      <th>Fecha Programada</th>
      <th>Fecha Realizado</th>
      <th>Realizado</th>
      <th></th>
    </tr>
  </thead>
  <tbody class="moveStock">
    <?php
    $x = 0;
    foreach ($fechas as $fecha){ ?>
      <tr>
        <input type="hidden" name="id_stock[]" value="<?=$fecha['id']?>">
        <td><?=++$x?></td>
        <td><?=$fecha['fecha_programado'] ?></td>
        <td><?=$fecha['fecha_realizado'] ?></td>
        <td><?=$fecha['realizado'] ?></td>
        <td><button type="button" name="button">Accion</button></td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script src ="<?= base_url('assets/js/dinamicScripts.js') ?>"> </script>

<script type="text/javascript">
$(document).ready( function () {
$('#tabla_').DataTable();
} );
</script>
