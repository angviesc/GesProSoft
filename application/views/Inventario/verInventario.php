<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/datatables.css') ?>">
<script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/datatables.js') ?>"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/boots.js') ?>"></script>

<main>
  <div class="container">
    <center>
      <h4>Articulos en existencia</h4>
    </center>
    <div class="right-align">
      <!--
      <?= anchor_popup('Sistemactrl/nuevoBio', 'Nuevo <i class="material-icons right">add</i>', $atts) ?>
      <a href="#" onclick="ventanaFlotante(this)" class="waves-effect waves-light btn blue-grey darken-3 disabled" name="editarBio" id="test">Editar<i class="material-icons right">edit</i></a>
      <a href="#modal1" class="waves-effect waves-light btn modal-trigger blue-grey darken-3 disabled" id="eliminarBio">Eliminar<i class="material-icons right">delete</i></a>
    -->
    </div>
    <table class="bordered highlight responsive-table tabla-paginada" id="table_id">
      <thead>
        <tr>
          <th>NO.</th>
          <th>Codigo</th>
          <th>Articulo</th>
          <th>Departamento</th>
          <th>Ubicación</th>
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
          <td><?=$articulo['codigo']?></td>
          <td><?=$articulo['articulo']?></td>
          <td><?=$articulo['departamento']?></td>
          <td><?=$articulo['almacen']?></td>
          <td><?=$articulo['cantidad']?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</main>


 <!-- Modal Structure -->
 <div id="modal1" class="modal">
   <?= form_open('Sistemactrl/eliminarBio')?>
   <div class="modal-content">
     <h4>Confirmacion</h4>
     <p>¿Esta seguro que desea eliminar al biomedico seleccionado?</p>
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
