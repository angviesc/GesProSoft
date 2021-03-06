<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/datatables.css') ?>">
<script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/datatables.js') ?>"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/boots.js') ?>"></script>

<main>
  <div class="container">
    <center>
      <h4>Lista de pedidos</h4>
    </center>
    <div class="right-align">
      <?= anchor_popup('Sistemactrl/nuevoPedido', 'Nuevo <i class="material-icons right">add</i>', $atts) ?>
      <a href="#" onclick="ventanaFlotante(this)" class="waves-effect waves-light btn blue-grey darken-3 disabled" name="verPedido" id="test">Ver Pedido<i class="material-icons right">visibility</i></a>
      <a href="#" class="waves-effect waves-light btn blue-grey darken-3 disabled" name="btn-recibe" id="btn-recibe">Recibir Pedido<i class="material-icons right">reply</i></a>
      <a href="#modal1" class="waves-effect waves-light btn modal-trigger blue-grey darken-3 disabled" id="btn-delete-pedido">Eliminar<i class="material-icons right">delete</i></a>
  </div>
  <table class="bordered highlight responsive-table tabla-paginada" id="table_id">
    <thead>
      <tr>
        <th>NO.</th>
        <th>Fecha de emisión</th>
        <th>Fecha de llegada</th>
        <th>Folio de seguimiento</th>
        <th>Proveedor</th>
        <th>Importe</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody id="tabla-pedidos">
      <?php
      $x = 0;
      foreach ($pedidos as $pedido) { ?>
        <tr>
          <?=form_hidden('id_us',$pedido['id']) ?>
          <?=form_hidden('status',$pedido['status']) ?>
          <td><?=++$x?></td>
          <td><?=$pedido['fecha_emision']?></td>
          <td><?=$pedido['fecha_llegada']?></td>
          <td><?=$pedido['nombre_pedido']?></td>
          <td><?=$pedido['proveedor']?></td>
          <td>$ <?=(empty($pedido['total']))? '0' : $pedido['total']?></td>
          <td><?=($pedido['status'] == 0)? 'Activo' : 'Recibido' ?></td>
        </tr>
      <?php  } ?>

    </tbody>
  </table>
</div>
</main>


 <!-- Modal Structure -->
 <div id="modal1" class="modal">
   <?= form_open('Sistemactrl/eliminarPedido')?>
   <div class="modal-content">
     <h4>Confirmacion</h4>
     <p>¿Esta seguro que desea eliminar el pedido seleccionado?</p>
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
