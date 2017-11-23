<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/datatables.css') ?>">
<script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/datatables.js') ?>"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/boots.js') ?>"></script>
<main>
  <div class="container">
    <h4>Mantenimiento a realizar hoy</h4>
    <table  id="tabla_">
      <thead>
        <tr>
          <th width = "5%">NO.</th>
          <th width = "20%">Equipo</th>
          <th width = "15%">Tipo</th>
          <th width = "20%">Fecha Programada</th>
          <th width = "20%">Fecha Realizado</th>
          <th width = "10%">Realizado</th>
          <th width = "10%"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $x = 0;
        foreach ($pendietes as $fecha){
          if ($fecha['realizado'])
          echo '<tr class="green lighten-3">';
          else
          echo '<tr>';
          ?>
          <input type="hidden" name="id_stock[]" value="<?=$fecha['id']?>">
          <td><?=++$x?></td>
          <td><?=$fecha['nombre'].'('.$fecha['codigo'].')'?></td>
          <td><?=$fecha['tipo']?></td>
          <td><?=$fecha['fecha_programado'] ?></td>
          <td><?=$fecha['fecha_realizado'] ?></td>
          <td class="center-align"><?=($fecha['realizado'])? '<i class="material-icons">check</i>': '<i class="material-icons">remove</i>' ; ?></td>
          <td><a href="<?=site_url('sistemactrl/realizarMant/'.$fecha['id']) ?>" class="waves-effect waves-light btn modal-trigger blue-grey darken-3 <?=($fecha['realizado'])? 'disabled' : '' ; ?>" id="eliminarBio">Realizar Mantenimiento</a></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</main>

<script type="text/javascript">
$(document).ready( function () {
$('#tabla_').DataTable();
} );
</script>
