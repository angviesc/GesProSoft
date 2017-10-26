<div class="container">
  <?= form_open('Sistemactrl/insertArticulo')?>
  <div class="row">

    <div class="col s12 ">
      <ul class="tabs ">
        <li class="tab col s3 "><a class="active blue-grey-text" href="#test1">Articulo</a></li>
        <li class="tab col s3"><a class="blue-grey-text" href="#test2">Inventario</a></li>
        <li class="tab col s6"></li>
      </ul>
    </div>

    <div id="test1" class="col s12 ">
      <h4>Nuevo Artículo</h4>
      <div class="input-field">
        <input type="text" name="codigo" id="codigo" required>
        <label for="codigo">Código:</label>
      </div>

      <div class="input-field">
        <input type="text" name="nombre" id="nombre" required>
        <label for="nombre">Nombre:</label>
      </div>

      <div class="input-field">
        <textarea name="descripcion" id="descripcion" class="materialize-textarea" rows="4" cols="80"></textarea>
        <label for="descripcion">Descripcion:</label>
      </div>

      <div class="input-field">
        <select id="id_departamento" name="id_departamento">
          <?=$selectDpto?>
        </select>
        <label>Departamento:</label>
      </div>

      <div class="input-field" id="select-area">
        <select disabled>
          <option value="" disabled selected>Selecciona un departamento</option>
        </select>
        <label >Area:</label>
      </div>

      <div class="input-field">
        <input type="number" step="0.01" min="0" name="costo_compra" id="costo_compra" required>
        <label for="costo_compra">Costo de compra:</label>
      </div>

      <div class="input-field">
        <input type="number" step="0.01" min="0" name="costo_venta" id="costo_venta" required>
        <label for="costo_venta">Costo de venta:</label>
      </div>

      <div class="input-field">
        <textarea name="nota" id="nota" class="materialize-textarea" rows="4" cols="80"></textarea>
        <label for="nota">Nota:</label>
      </div>

      <div class="switch">
        Equipo unico
        <label>
          No
          <input type="checkbox" name = "equipo-unico" id="ctrl-active">
          <span class="lever"></span>
          Sí
        </label>
      </div>

      <div class="input-field">
        <input type="text" disabled class="bloqueado" name="marca" id="marca" required>
        <label for="marca">Marca:</label>
      </div>

      <div class="input-field">
        <input type="text" disabled class="bloqueado" name="modelo" id="modelo" required>
        <label for="modelo">Modelo:</label>
      </div>

      <div class="input-field">
        <input type="text" disabled class="bloqueado" name="serie" id="serie" required>
        <label for="serie">Serie</label>
      </div>
    </div>


    <div id="test2" class="col s12">

        <h4>Inventario</h4>


      <div class="input-field">
        <table>
          <thead>
            <tr>
              <th>Ubicación</th>
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>o</td>
              <td>k</td>
            </tr>
          </tbody>
          <tfoot>
            <tr >
              <td colspan="2" class="right-align"><button type="button" name="button">TEXT</button></td>
            </tr>
          </tfoot>
        </table>
      </div>

      <div class="input-field">
        <input type="text" name="nombre" id="nombre" >
        <label for="nombre">Proveedor:</label>
      </div>

    </div>

  </div>

  <div class="row">
    <?= form_submit('submitGua','Guardar','class="col s6 btn waves-effect green darken-3"')?>
    <button type="button" name="button" class="col s6 btn waves-effect red lighten-1" onclick="cerrarVentana()">Cancelar</button>
  </div>
  <?= form_close()?>
</div>
<input type="hidden" name="site_url" id="site_url" value="<?=site_url()?>">
