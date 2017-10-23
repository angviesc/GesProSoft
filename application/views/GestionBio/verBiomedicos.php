<div class="container">
  <?= anchor_popup('Sistemactrl/nuevoBio', 'Nuevo', $atts) ?>
  <a href="#">Editar </a>
  <a href="#">Eliminar </a>
  <table class="bordered highlight">
    <thead>
      <tr>
        <th>NO.</th>
        <th>Nombre</th>
        <th>Usuario</th>
      </tr>
    </thead>
    <tbody>
      <?php $x = 0;
      foreach ($biomedicos as $biomedico) { ?>
        <tr>
          <?=form_hidden('id_us',$biomedico['id']) ?>
          <td><?=++$x?></td>
          <td><?=$biomedico['nombre'].' '.$biomedico['apellidop'].' '.$biomedico['apellidom']?></td>
          <td><?=$biomedico['usuario']?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
