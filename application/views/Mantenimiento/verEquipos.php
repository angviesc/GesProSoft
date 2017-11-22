<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/datatables.css') ?>">
<script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/datatables.js') ?>"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/boots.js') ?>"></script>

<main>
  <div class="container">
    <center>
      <h4>--</h4>
    </center>
    <div class="right-align">
      <!--
      <a href="#" onclick="ventanaFlotante(this)" class="waves-effect waves-light btn blue-grey darken-3 disabled" name="programarMant" id="test">Programar Mantenimiento<i class="material-icons right">edit</i></a>
      <?= anchor_popup('Sistemactrl/nuevoBio', 'Nuevo <i class="material-icons right">add</i>', $atts) ?>
      -->
      <a href="#modal1" class="waves-effect waves-light btn modal-trigger blue-grey darken-3 disabled" id="eliminarBio">Programar Mantenimiento<i class="material-icons right">border_color</i></a>
    </div>
    <table class="bordered highlight responsive-table tabla-paginada" id="table_id">
      <thead>
        <tr>
          <th>NO.</th>
          <th>Articulo (Codigo)</th>
          <th>Serie</th>
          <th>Departamento</th>
          <th>Ubicación</th>
        </tr>
      </thead>
      <tbody class="equiposUnicos">
        <?php $x = 0;
        foreach ($articulos as $articulo) { ?>
          <tr>
            <?=form_hidden('id_us',$articulo['id']) ?>
            <td><?=++$x?></td>
            <td><?=$articulo['nombre'].'('.$articulo['codigo'].')'?></td>
            <td><?=$articulo['serie']?></td>
            <td><?=$articulo['departamento']?></td>
            <td><?=$articulo['almacen']?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    
    <div class="" id="calendarioMant">

    </div>
  </div>



</main>

<!-- Modal Structure -->
<div id="modal1" class="modal">
  <?= form_open('Sistemactrl/programarMant')?>
  <div class="modal-content">
    <h4>Programar mantenimiento</h4>
    <input type="hidden" name="id_activo" id="id_activo" value="" />
    <br>
    <div class="">
      <h5>Tipo de Mantenimiento</h5>
      <p>
        <input name="mantenimiento" value="1" type="radio" id="test1" required/>
        <label for="test1">Preventivo</label>
      </p>
      <p>
        <input name="mantenimiento" value="2" type="radio" id="test2" required/>
        <label for="test2">Correctivo</label>
      </p>
    </div>
    <br>
    <div class="input-field">
      <input type="text" class="datepicker" name="fecha_instalacion" id="fecha_instalacion" required>
      <label for="fecha_instalacion">Fecha programada</label>
    </div>
    <br>
    <div class="input-field">
      <input type="number" step="0.01" min="0" name="costo_venta" id="costo_venta" required>
      <label for="costo_venta">Costo presupuestado:</label>
    </div>
  </div>


  <div class="modal-footer">
    <?= form_submit('submitGua','ACEPTAR','class="modal-action waves-effect waves-green btn-flat"')?>
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
  </div>
<?= form_close()?>
</div>
<input type="hidden" name="site_url" id="site_url" value="<?=site_url('Sistemactrl')?>" />

<script type="text/javascript">
$(document).ready( function () {
$('#table_id').DataTable();
} );
</script>
