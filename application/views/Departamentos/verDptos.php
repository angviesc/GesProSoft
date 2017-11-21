<main>
  <div class="container">
    <center>
      <h4>Lista de Departamentos</h4>
    </center>
    <div class="right-align">
      <?= anchor_popup('Sistemactrl/nuevoDpto', 'Nuevo <i class="material-icons right">add</i>', $atts) ?>
      <a href="#" onclick="ventanaFlotante(this)" class="waves-effect waves-light btn blue-grey darken-3 disabled" name="editarDpto">Editar<i class="material-icons right">edit</i></a>
      <a href="#modal1" class="waves-effect waves-light btn modal-trigger blue-grey darken-3 disabled" id="eliminarBio">Eliminar<i class="material-icons right">delete</i></a>
    </div>
    <table class="bordered highlight">
      <thead>
        <tr>
          <th>NO.</th>
          <th>Departamento</th>
          <th>Areas</th>
        </tr>
      </thead>
      <tbody>
        <?php $x = 0;
        foreach ($departamentos as $departamento) { ?>
          <tr>
            <?=form_hidden('id_us',$departamento['id']) ?>
            <td><?=++$x?></td>
            <td><?=$departamento['nombre']?></td>
            <td><?= (isset($areas[$departamento['id']]))? $areas[$departamento['id']] : '' ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>  
</main>


  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <?= form_open('Sistemactrl/eliminarDpto')?>
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
