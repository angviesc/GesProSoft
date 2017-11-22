 
   <?php
   //echo "<pre>";   print_r($bitacora);
   ?>

   <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/datatables.css') ?>">
   <script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/datatables.js') ?>"></script>
   <script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/boots.js') ?>"></script>

   <main>
     <div class="container">
       <center>
         <h4>Bitacora</h4>
       </center>

       <div class="right-align">
         <!--
         <?= anchor_popup('Sistemactrl/nuevoCliente', 'Nuevo <i class="material-icons right">add</i>', $atts) ?>
         <a href="#" onclick="ventanaFlotante(this)" class="waves-effect waves-light btn blue-grey darken-3 disabled" name="editarCliente" >Editar<i class="material-icons right">edit</i></a>
         <a href="#modal1" class="waves-effect waves-light btn modal-trigger blue-grey darken-3 disabled" id="eliminarBio">Eliminar<i class="material-icons right">delete</i></a>
       -->
       </div>
       <table class="bordered highlight responsive-table tabla-paginada" id="table_id">
         <thead>
           <tr>
             <th>NO.</th>
             <th>Usuario</th>
             <th>Accion</th>
             <th>Dispositivo</th>
             <th>Tabla</th>
             <th>Fecha</th>
           </tr>
         </thead>
         <tbody>
           <?php
           $x = 0;
           foreach ($bitacora as $accion){ ?>
             <tr>
               <!--
               <?=form_hidden('id_us',$cliente['id']) ?>
               -->
               <td><?=++$x?></td>
               <td><?=$accion['usuario']?></td>
               <td><?=$accion['accion']?></td>
               <td><?=$accion['dispositivo']?></td>
               <td><?=$accion['tabla']?></td>
               <td><?=$accion['fecha']?></td>
             </tr>
           <?php } ?>
         </tbody>
       </table>
     </div>
   </main>

   <!-- Modal Structure
   <div id="modal1" class="modal">
     <?= form_open('Sistemactrl/eliminarCliente')?>
     <div class="modal-content">
       <h4>Confirmacion</h4>
       <p>¿Esta seguro que desea eliminar el cliente seleccionado?</p>
       <input type="hidden" name="id_activo" id="id_activo" value="" />
     </div>
     <div class="modal-footer">
       <?= form_submit('submitGua','ACEPTAR','class="modal-action waves-effect waves-green btn-flat"')?>
       <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
     </div>
   <?= form_close()?>
   </div>
   <input type="hidden" name="link" id="link" value="<?=site_url('Sistemactrl')?>" />
 -->
   <script type="text/javascript">
   $(document).ready( function () {
   $('#table_id').DataTable();
   } );
   </script>
