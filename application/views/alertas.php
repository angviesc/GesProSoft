<div class="fixed-action-btn click-to-toggle">
  <?php if (empty($pendietes))
    echo '<a class="btn btn-floating btn-large light-green darken-3 "><i class="large material-icons">tag_faces</i></a>';
  else
    echo '<a href="'.site_url('Sistemactrl/pendieteMant').'" class="btn btn-floating btn-large amber pulse"><i class="large material-icons">warning</i></a>';

   ?>
</div>
