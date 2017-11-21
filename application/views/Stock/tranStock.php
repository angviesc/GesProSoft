<main>
  <div class="container">
    <h6>Seleccione Stock que desea transferir</h6>
    <div class="input-field" >
      <select name="selectStock" id="selectStock">
        <?=$selectAlm?>
      </select>
      <label >Transferir de la ubicación:</label>
    </div>

    <div id="stockOrigen">
      <table>
        <thead>
          <tr>
            <th>Codigo</th>
            <th>Articulo</th>
            <th>Descripción</th>
            <th>Ubicación</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="input-field" >
      <select name="alm_dest" id="alm_dest">
        <?=$selectAlm?>
      </select>
      <label >Transferir a la ubicación:</label>
    </div>
    <div class="input-field" >
      <input type="number" id="cant-trans" name="cant-trans" value="">
      <label for="cant-trans">Cantidad:</label>
    </div>
    <a href="#" class="waves-effect waves-light btn modal-trigger blue-grey darken-3 disabled" id="btn-stock">Transferir<i class="material-icons right">delete</i></a>

  </div>
</main>

<input type="hidden" name="site_url" id="site_url" value="<?=site_url()?>">
