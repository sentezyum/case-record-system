<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo Router::url('/'); ?>"><i class="fa fa-balance-scale"></i></a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-left">
        <?php if (isset($user) && !empty($user)) { ?>
          <li menu><?php echo $this->Html->link("Davalar", array('controller' => 'cases', 'action' => 'index')); ?></li>
          <?php if ($user['User']['is_admin']) { ?>
            <li menu><?php echo $this->Html->link("Yeni dava ekle", array('controller' => 'cases', 'action' => 'add')); ?></li>
            <li menu><?php echo $this->Html->link("Firmalar", array('controller' => 'customers', 'action' => 'index')); ?></li>
            <li menu><?php echo $this->Html->link("Firma Ekle", array('controller' => 'customers', 'action' => 'add')); ?></li>
          <?php } ?>
        <?php } ?>
      </ul>

      <?php if (isset($user) && !empty($user)) { ?>
        <ul class="nav navbar-nav navbar-right">
            <li menu>
              <?php echo $this->Html->link(Hash::get($user, 'User.mail') . ' <span class="caret"></span>', '#', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'escape' => false)); ?>
              <ul class="dropdown-menu">
                <li><?php echo $this->Html->link("Çıkış", array('controller' => 'users', 'action' => 'logout')); ?></li>
              </ul>
            </li>
        </ul>
      <?php } ?>
    </div>
  </div>
</nav>
