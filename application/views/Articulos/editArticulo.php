<div class="container">
  <?= form_open('Sistemactrl/actualizaArt','', array('id' => $articulo[0]['id'] ))?>

      <h4>Editar Artículo</h4>
      <div class="input-field">
        <input type="text" name="codigo" id="codigo" value="<?=$articulo[0]['codigo']?>" required>
        <label for="codigo">Código:</label>
      </div>

      <div class="input-field">
        <input type="text" name="nombre" id="nombre" value="<?=$articulo[0]['nombre']?>" required>
        <label for="nombre">Nombre:</label>
      </div>

      <?php if ($articulo[0]['id_articulo'] != null) { ?>
        <div class="input-field">
          <input type="text" class="bloqueado" name="marca" id="marca" value="<?=$articulo[0]['marca']?>" required>
          <label for="marca">Marca:</label>
        </div>

        <div class="input-field">
          <input type="text" class="bloqueado" name="modelo" id="modelo" value="<?=$articulo[0]['modelo']?>" required>
          <label for="modelo">Modelo:</label>
        </div>

        <div class="input-field">
          <input type="text" class="bloqueado" name="serie" id="serie" value="<?=$articulo[0]['serie']?>" required>
          <label for="serie">Serie</label>
        </div>

       <?php } ?>

      <div class="input-field">
        <textarea name="descripcion" id="descripcion" class="materialize-textarea" rows="4" cols="80"><?=str_replace('<br />','',$articulo[0]['descripcion'])?></textarea>
        <label for="descripcion">Descripcion:</label>
      </div>

      <div class="input-field">
        <select id="id_departamento" name="id_departamento">
          <?=$selectDpto?>
        </select>
        <label>Departamento:</label>
      </div>

      <div class="input-field" id="select-area">
        <?=$selectArea?>
        <label >Area:</label>
      </div>

      <div class="input-field">
        <input type="number" step="0.01" min="0" name="costo_compra" id="costo_compra" value="<?=$articulo[0]['costo_compra']?>"required>
        <label for="costo_compra">Costo de compra:</label>
      </div>

      <div class="input-field">
        <input type="number" step="0.01" min="0" name="costo_venta" id="costo_venta" value="<?=$articulo[0]['costo_venta']?>" required>
        <label for="costo_venta">Costo de venta:</label>
      </div>
<?php if ($articulo[0]['id_articulo'] != null) { ?>

      <div class="input-field">
        <input type="text" class="datepicker bloqueado" name="fecha_instalacion" id="fecha_instalacion" data-value="<?=$articulo[0]['fecha_instalacion']?>" required>
        <label for="fecha_instalacion">Fecha de instalacion</label>
      </div>

      <div class="">
        <h5>Status</h5>
        <p>
          <input name="status" class="bloqueado" value="1" type="radio" id="test1" <?=($articulo[0]['status'] == 1)? 'checked': ''?> required/>
          <label for="test1">Propio</label>
        </p>
        <p>
          <input name="status" class="bloqueado" value="2" type="radio" id="test2" <?=($articulo[0]['status'] == 2)? 'checked': ''?> required/>
          <label for="test2">Por contrato</label>
        </p>
        <p>
          <input name="status" class="bloqueado" value="3" type="radio" id="test3" <?=($articulo[0]['status'] == 3)? 'checked': ''?> required/>
          <label for="test3">En garantia</label>
        </p>
        <p>
          <input name="status" class="bloqueado" value="4" type="radio" id="test4" <?=($articulo[0]['status'] == 4)? 'checked': ''?> required/>
          <label for="test4">Subrogado</label>
        </p>
      </div>

      <div class="input-field" >
        <select id="id_proveedor" name="id_proveedor" class="bloqueado">
          <?=$selectProv?>
        </select>
        <label for="nombre">Proveedor:</label>
      </div>
<?php } ?>
      <div class="input-field">
        <textarea name="nota" id="nota" class="materialize-textarea" rows="4" cols="80"><?=str_replace('<br />','',$articulo[0]['nota'])?></textarea>
        <label for="nota">Nota:</label>
      </div>

  <div class="row">
    <?= form_submit('submitGua','Guardar','class="col s6 btn waves-effect green darken-3"')?>
    <button type="button" name="button" class="col s6 btn waves-effect red lighten-1" onclick="cerrarVentana()">Cancelar</button>
  </div>
  <?= form_close()?>
</div>
<input type="hidden" name="site_url" id="site_url" value="<?=site_url()?>">
