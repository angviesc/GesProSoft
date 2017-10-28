<div class="container">
  <?= form_open('Sistemactrl/insertarDpto')?>
  <h4>Nuevo Departamento</h4>
  <div class="input-field">
    <input type="text" name="nombre" id="nombre" required>
    <label for="nombre">Nombre:</label>
  </div>
  <h5>Areas</h5>
  <table class="bordered highlight" id="tabla-dinamica">
    <thead>
      <tr>
        <th>Nombre</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="reglon-editable">
          <input type="text" name="areas[]" class="input-tabla" style="margin-bottom: 1px; height: 1rem; " value="">
        </td>
      </tr>
      <tr>
        <td class="reglon-editable">

        </td>
      </tr>
      <tr>
        <td class="reglon-editable"></td>
      </tr>
      <tr>
        <td class=""></td>
      </tr>
      <tr>
        <td class=""></td>
      </tr>
    </tbody>
    <tfoot>
      <td class="right-align">
        <button type="button" class="waves-effect waves-light btn blue-grey darken-3" name="addArea" id="addArea">Añadir<i class="material-icons right">add</i></button>
        <button type="button" class="waves-effect waves-light btn blue-grey darken-3 disabled" name="editarBio" id="test">Editar<i class="material-icons right">edit</i></button>
        <button type="button" class="waves-effect waves-light btn blue-grey darken-3 disabled">Eliminar<i class="material-icons right">delete</i></button>
      </td>
    </tfoot>
  </table>
  <br>

  <div class="row">
    <?= form_submit('submitGua','Guardar','class="col s6 btn waves-effect green darken-3"')?>
    <button type="button" name="button" class="col s6 btn waves-effect red lighten-1" onclick="cerrarVentana()">Cancelar</button>
  </div>
  <?= form_close()?>
</div>
