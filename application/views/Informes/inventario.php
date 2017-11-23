
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/datatables.css') ?>">
<script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/datatables.js') ?>"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/boots.js') ?>"></script>

<table class="bordered highlight responsive-table tabla-paginada" id="table_id">
  <thead>
    <tr>
      <th>NO.</th>
      <th>Articulo</th>
      <th>Codigo</th>
      <th>Marca</th>
      <th>Modelo</th>
      <th>Departamento</th>
      <th>Área</th>
      <th>Costo compra</th>
      <th>Costo venta</th>
      <th>Almacen</th>
      <th>Cantidad</th>
    </tr>
  </thead>
  <tbody>
    <?php $x = 0;
    foreach ($inventario as $articulo) { ?>
      <tr>
        <!--
        <?=form_hidden('id_us',$articulo['id']) ?>
      -->
      <td><?=++$x?></td>
      <td><?=$articulo['articulo']?></td>
      <td><?=$articulo['codigo']?></td>
      <td><?=$articulo['marca']?></td>
      <td><?=$articulo['modelo']?></td>
      <td><?=$articulo['departamento']?></td>
      <td><?=$articulo['area']?></td>
      <td><?=$articulo['costo_compra']?></td>
      <td><?=$articulo['costo_venta']?></td>
      <td><?=$articulo['almacen']?></td>
      <td><?=$articulo['cantidad']?></td>
    </tr>
  <?php } ?>
</tbody>
</table>

<div class="row">
  <?= form_submit('submitGua','Descargar','class="btn waves-effect green darken-3"')?>
</div>
<?= form_close()?>

<script type="text/javascript">
$(document).ready( function () {
$('#table_id').DataTable();
} );
</script>
