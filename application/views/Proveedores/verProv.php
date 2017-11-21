<main>
  <div class="container">
    <center>
      <h4>Lista de Proveedores</h4>
    </center>

    <div class="right-align">
      <?= anchor_popup('Sistemactrl/nuevoProv', 'Nuevo <i class="material-icons right">add</i>', $atts) ?>
      <a href="#" onclick="ventanaFlotante(this)" class="waves-effect waves-light btn blue-grey darken-3 disabled" name="editarProv" >Editar<i class="material-icons right">edit</i></a>
      <a href="#modal1" class="waves-effect waves-light btn modal-trigger blue-grey darken-3 disabled" id="eliminarBio">Eliminar<i class="material-icons right">delete</i></a>
    </div>
    <table class="bordered highlight">
      <thead>
        <tr>
          <th>NO.</th>
          <th>Proveedor</th>
          <th>Nombre</th>
          <th>Telefono</th>
          <th>Correo electronico</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $x = 0;
        foreach ($proveedores as $proveedor){ ?>
          <tr>
            <?=form_hidden('id_us',$proveedor['id']) ?>
            <td><?=++$x?></td>
            <td><?=$proveedor['nombre_proveedor']?></td>
            <td><?=$proveedor['nombre'].' '.$proveedor['apellidop'].' '.$proveedor['apellidom']?></td>
            <td><?=$proveedor['telefono']?><?=(!empty($proveedor['tel_atl']))? '<br>Tel. Alt.:'.$proveedor['tel_atl'] : '' ?></td>
            <td><?=$proveedor['email']?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>  
</main>

<!-- Modal Structure -->
<div id="modal1" class="modal">
  <?= form_open('Sistemactrl/eliminarProv')?>
  <div class="modal-content">
    <h4>Confirmacion</h4>
    <p>¿Esta seguro que desea eliminar al proveedor seleccionado?</p>
    <input type="hidden" name="id_activo" id="id_activo" value="" />
  </div>
  <div class="modal-footer">
    <?= form_submit('submitGua','ACEPTAR','class="modal-action waves-effect waves-green btn-flat"')?>
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
  </div>
<?= form_close()?>
</div>
<input type="hidden" name="link" id="link" value="<?=site_url('Sistemactrl')?>" />
