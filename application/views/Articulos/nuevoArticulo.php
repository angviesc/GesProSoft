<div class="container">
  <?= form_open('Sistemactrl/insertArticulo')?>
  <div class="row">

    <div class="col s12 ">
      <ul class="tabs ">
        <li class="tab col s3 "><a class="active blue-grey-text" href="#Sarticulo">Articulo</a></li>
        <li class="tab col s3"><a class="blue-grey-text" href="#Sinventario">Inventario</a></li>
        <li class="tab col s6"></li>
      </ul>
    </div>

    <div id="Sarticulo" class="col s12 ">
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
          <option value="" disabled selected>Selecciona un área</option>
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

      <div class="input-field">
        <input type="text" disabled class="datepicker bloqueado" name="fecha_instalacion" id="fecha_instalacion" required>
        <label for="fecha_instalacion">Fecha de instalacion</label>
      </div>

    </div>


    <div id="Sinventario" class="col s12">
        <h4>Inventario</h4>
      <div class="input-field">
        <table class="bordered highlight" id="tabla-dinamica">
          <thead>
            <tr>
              <th width="80%">Ubicación</th>
              <th width="20%">Cantidad</th>
            </tr>
          </thead>
          <tbody id="tb_inventario">
            <tr>
              <td class="reglon-alineado">
                <div class="input-field">
                  <select name="id_almacen[]">
                    <?=$selectAlm?>
                  </select>
                  <label>Proveedores:</label>
                </div>
              </td>
              <td class="reglon-alineado"><input type="number" class="contador_inv"  name="cantidad[]" min=0></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th class="right-align " >Piezas totales </th>
              <td id="totalPzas"></td>
            </tr>
            <tr>
              <td colspan="2" class="right-align">
                <button type="button" class="waves-effect waves-light btn blue-grey darken-3" name="btn-add-inv" id="btn-add-inv">Añadir<i class="material-icons right">add</i></button>
                <a href="#" class="waves-effect waves-light btn blue-grey darken-3 disabled delete-renglon" name="btn-delete-area" id="btn-delete-inv">Eliminar<i class="material-icons right">delete</i></a>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>

      <div class="">
        <h5>Status</h5>
        <p>
          <input name="status" disabled class="bloqueado" value="1" type="radio" id="test1" required/>
          <label for="test1">Propio</label>
        </p>
        <p>
          <input name="status" disabled class="bloqueado" value="2" type="radio" id="test2" required/>
          <label for="test2">Por contrato</label>
        </p>
        <p>
          <input name="status" disabled class="bloqueado" value="3" type="radio" id="test3" required/>
          <label for="test3">En garantia</label>
        </p>
        <p>
          <input name="status" disabled class="bloqueado" value="4" type="radio" id="test4" required/>
          <label for="test4">Subrogado</label>
        </p>
      </div>

      <div class="input-field" >
        <select id="id_proveedor" name="id_proveedor" disabled class="bloqueado">
          <?=$selectProv?>
        </select>
        <label for="nombre">Proveedor:</label>
      </div>

    </div>

    <input type="hidden" id="almacenesSelect" value='<?=$selectAlm?>'>

  </div>

  <div class="row">
    <?= form_submit('submitGua','Guardar','class="col s6 btn waves-effect green darken-3"')?>
    <button type="button" name="button" class="col s6 btn waves-effect red lighten-1" onclick="cerrarVentana()">Cancelar</button>
  </div>
  <?= form_close()?>
</div>
<input type="hidden" name="site_url" id="site_url" value="<?=site_url()?>">
