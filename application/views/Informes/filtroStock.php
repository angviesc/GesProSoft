<main>
  <div class="container">

    <h4>Selecciona Departamento y/o almacen</h4>
      <?= form_open('Sistemactrl/excelInventarioFiltro','',$sed)?>
    <div class="input-field">
      <select id="id_departamento" name="id_departamento" class="filtro">
        <?=$selectDpto?>
      </select>
      <label>Departamento:</label>
    </div>

    <div class="input-field">
      <select id="id_almacen" name="id_almacen" class="filtro">
        <?=$selectAlm?>
      </select>
      <label>Almacen:</label>
    </div>

    <div id="tabla_inventario">

    </div>

  </div>
</main>
<input type="hidden" name="site_url" id="site_url" value="<?=site_url('Sistemactrl')?>" />
