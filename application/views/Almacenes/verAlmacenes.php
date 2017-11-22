<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/datatables.css') ?>">

<script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/datatables.js') ?>"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/boots.js') ?>"></script>

<main>
  <div class="container">
    <center>
      <h4>Lista de Almacenes</h4>
    </center>
    <div class="right-align">
      <?= anchor_popup('Sistemactrl/nuevoAlm', 'Nuevo <i class="material-icons right">add</i>', $atts) ?>
      <a href="#" onclick="ventanaFlotante(this)" class="waves-effect waves-light btn blue-grey darken-3 disabled" name="editarAlm" id="test">Editar<i class="material-icons right">edit</i></a>
      <a href="#modal1" class="waves-effect waves-light btn modal-trigger blue-grey darken-3 disabled" id="eliminarBio">Eliminar<i class="material-icons right">delete</i></a>
    </div>
    <table class="bordered highlight responsive-table tabla-paginada">
      <thead>
        <tr>
          <th width = "10%">NO.</th>
          <th width = "40%">Nombre</th>
          <th width = "50%">Ubicación</th>
        </tr>
      </thead>
      <tbody>
        <?php $x = 0;
        foreach ($almacenes as $almacen) { ?>
          <tr>
            <?=form_hidden('id_us',$almacen['id']) ?>
            <?=($almacen['id']==1)? form_hidden('id_tipo',1) : '' ?>
            <td><?=++$x?></td>
            <td><?=$almacen['nombre']?></td>
            <td><?=$almacen['ubicacion']?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</main>


  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <?= form_open('Sistemactrl/eliminarAlm')?>
    <div class="modal-content">
      <h4>Confirmacion</h4>
      <p>¿Esta seguro que desea eliminar el almacen seleccionado?</p>
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
   $('.tabla-paginada').DataTable();
 } );
 </script>
