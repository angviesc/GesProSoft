
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/datatables.css') ?>">

<script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/datatables.js') ?>"></script>
<script type="text/javascript" charset="utf8" src="<?= base_url('assets/js/boots.js') ?>"></script>

<main>
  <div class="container">
  <h3>TEST</h3>

    <table id="table_id" class="responsive-table">
      <thead>
        <tr>
          <th>Campo 1</th>
          <th>Campo 1</th>
          <th>Campo 1</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>date_default_timezone_set</td>
          <td>otro mas</td>
          <td>:D</td>
        </tr>
      </tbody>
    </table>
  </div>

</main>

<script type="text/javascript">
$(document).ready( function () {

  $('#table_id').DataTable();
} );
</script>
