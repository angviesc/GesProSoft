 <div class="container">
   <center>
     <h4>Lista de Almacenes</h4>
   </center>
   <div class="right-align">
     <?= anchor_popup('Sistemactrl/nuevoAlm', 'Nuevo <i class="material-icons right">add</i>', $atts) ?>
     <a href="#" onclick="ventanaFlotante(this)" class="waves-effect waves-light btn blue-grey darken-3 disabled" name="editarAlm" id="test">Editar<i class="material-icons right">edit</i></a>
     <a href="#modal1" class="waves-effect waves-light btn modal-trigger blue-grey darken-3 disabled" id="eliminarBio">Eliminar<i class="material-icons right">delete</i></a>
   </div>
   <table class="bordered highlight">
     <thead>
       <tr>
         <th>NO.</th>
         <th>Nombre</th>
         <th>Ubicación</th>
       </tr>
     </thead>
     <tbody>
       <?php $x = 0;
       foreach ($almacenes as $almacen) { ?>
         <tr>
           <?=form_hidden('id_us',$almacen['id']) ?>
           <td><?=++$x?></td>
           <td><?=$almacen['nombre']?></td>
           <td><?=$almacen['ubicacion']?></td>
         </tr>
       <?php } ?>
     </tbody>
   </table>
 </div>


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
