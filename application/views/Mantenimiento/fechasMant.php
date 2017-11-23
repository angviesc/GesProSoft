<table  id="tabla_">
  <thead>
    <tr>
      <th width = "5%">NO.</th>
      <th width = "10%">Tipo</th>
      <th width = "25%">Fecha Programada</th>
      <th width = "25%">Fecha Realizado</th>
      <th width = "25%">Realizado</th>
      <th width = "10%"></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $x = 0;
    foreach ($fechas as $fecha){
      if ($fecha['realizado'])
        echo '<tr class="green lighten-3">';
      else
        echo '<tr>';
      ?>
        <input type="hidden" name="id_stock[]" value="<?=$fecha['id']?>">
        <td><?=++$x?></td>
        <td><?=$fecha['tipo']?></td>
        <td><?=$fecha['fecha_programado'] ?></td>
        <td><?=$fecha['fecha_realizado'] ?></td>
        <td class="center-align"><?=($fecha['realizado'])? '<i class="material-icons">check</i>': '<i class="material-icons">remove</i>' ; ?></td>
        <td><a href="<?=site_url('sistemactrl/realizarMant/'.$fecha['id']) ?>" class="waves-effect waves-light btn modal-trigger blue-grey darken-3 <?=($fecha['realizado'])? 'disabled' : '' ; ?>" id="eliminarBio">Realizar Mantenimiento</a></td>
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
