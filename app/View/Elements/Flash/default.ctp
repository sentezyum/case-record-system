<div id="<?php echo $key; ?>Message" class="alert alert-<?php echo !empty($params['class']) ? $params['class'] : 'info'; ?> alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <?php echo $message; ?>
</div>
