<?php
  $title = isset($title) ? $title : $this->request->controller . '/' . $this->request->action;
  $icon = isset($icon) ? $icon : "fa-file";
?>
<div class="page-header" style="margin-top:20px;">
  <h3>
    <i class="fa <?php echo $icon; ?>"></i> <?php echo $title; ?>
    <?php if (isset($links) && is_array($links) && !empty($links)) { ?>
      <div class="btn-group btn-group-sm pull-right">
        <?php
          foreach ($links as $title => $target)
            echo $this->Html->link($title, $target, array('class' => 'btn btn-default'));
        ?>
      </div>
    <?php } ?>
  </h3>
</div>
