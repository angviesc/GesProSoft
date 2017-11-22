<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/datatables.css') ?>">

<script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/datatables.js') ?>"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/boots.js') ?>"></script>

<main>
  <div class="container">
    <center>
      <h4>Lista de Articulos en el sistema</h4>
    </center>
    <div class="right-align">

        <?= anchor_popup('Sistemactrl/nuevoArticulo', 'Nuevo <i class="material-icons right">add</i>', $atts) ?>

        <a href="#" onclick="ventanaFlotante(this)" class="waves-effect waves-light btn blue-grey darken-3 disabled" name="editArticulo" id="test">Editar<i class="material-icons right">edit</i></a>

        <a href="#modal1" class="waves-effect waves-light btn modal-trigger blue-grey darken-3 disabled" id="eliminarBio">Eliminar<i class="material-icons right">delete</i></a>

    </div>

    <table class="bordered highlight responsive-table tabla-paginada" id="table_id">
      <thead>
        <tr>
          <th width = "5%">NO.</th>
          <th width = "20%">Codigo</th>
          <th width = "20%">Nombre</th>
          <th width = "20%">Serie</th>
          <th width = "20%">Costo compra</th>
          <th width = "15%">Costo venta</th>
        </tr>
      </thead>
      <tbody>
        <?php $x = 0;
        foreach ($articulos as $articulo) { ?>
          <tr>
            <?=form_hidden('id_us',$articulo['id']) ?>
            <td><?=++$x?></td>
            <td><?=$articulo['codigo']?></td>
            <td><?=$articulo['nombre']?></td>
            <td><?=$articulo['serie']?></td>
            <td>$<?=$articulo['costo_compra']?></td>
            <td>$<?=$articulo['costo_venta']?></td>
          </tr>
        <?php } ?>
      </tbody>      
    </table>
  </div>
</main>


 <!-- Modal Structure -->
 <div id="modal1" class="modal">
   <?= form_open('Sistemactrl/eliminarArt')?>
   <div class="modal-content">
     <h4>Confirmacion</h4>
     <p>¿Esta seguro que desea eliminar el articulo seleccionado?</p>
     <input type="hidden" name="id_activo" id="id_activo" value="" />
   </div>
   <div class="modal-footer">
     <?= form_submit('submitGua','ACEPTAR','class="modal-action waves-effect waves-green btn-flat"')?>
     <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
   </div>
 <?= form_close()?>
 </div>

<input type="hidden" name="link" id="link" value="<?=site_url('Sistemactrl')?>" />

<script type="text/javascript">
$(document).ready( function () {
  $('#table_id').DataTable();
} );
</script>
