<div class="container">
  <?= form_open('Sistemactrl/actualizarDpto','',array('id_departamento' => $departamentos[0]['id_dpto'] ))?>
  <h4>Editar Departamento</h4>
  <div class="input-field">
    <input type="text" name="nombre" id="nombre" value="<?=$departamentos[0]['nombre_dpto']?>" required>
    <label for="nombre">Nombre:</label>
  </div>
  <h5>Areas</h5>
  <table class="bordered highlight" id="tabla-dinamica">
    <thead>
      <tr>
        <th >Nombre</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $x = 0;
      foreach ($departamentos as $area){
        if ($area['id_area'] != null){  ?>
        <tr>
          <input type="hidden" name="id_area[]" value="<?=$area['id_area']?>" />
          <td><?=$area['nombre_area']?></td>
        </tr>
      <?php }
      else {
        echo "<tr><td></td><td></td></tr>";
      }
    } ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2" class="right-align">
          <button type="button" class="waves-effect waves-light btn blue-grey darken-3" name="btn-add-area" id="btn-add-area">Añadir<i class="material-icons right">add</i></button>
          <a href="#" class="waves-effect waves-light btn blue-grey darken-3 disabled" name="btn-edit-area" id="btn-edit-area">Editar<i class="material-icons right">edit</i></a>
          <a href="#" class="waves-effect waves-light btn blue-grey darken-3 disabled" name="btn-delete-area" id="btn-elinar-area">Eliminar<i class="material-icons right">delete</i></a>
        </td>
      </tr>
    </tfoot>
  </table>
  <br>

  <div class="row">
    <?= form_submit('submitGua','Guardar','class="col s6 btn waves-effect green darken-3"')?>
    <button type="button" name="button" class="col s6 btn waves-effect red lighten-1" onclick="cerrarVentana()">Cancelar</button>
  </div>
  <?= form_close()?>
</div>
