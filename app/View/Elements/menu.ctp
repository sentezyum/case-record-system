<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo Router::url('/'); ?>"><i class="fa fa-balance-scale"></i></a>
      <ol class="breadcrumb visible-xs" style="margin-top: 8px;margin-bottom: 0px;margin-left:15px;">
        <li ng-repeat="item in breadCrumb" ng-class="{active: !item.link}">
          <span style="margin-left:-6px;" ng-if="!item.link">{{item.title}}</span>
          <a ng-if="item.link" href="{{item.link}}">{{item.title}}</a>
        </li>
      </ol>
    </div>
    <div class="collapse navbar-collapse" id="main-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-left">
        <?php if (isset($user) && !empty($user)) { ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Davalar <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li menu><?php echo $this->Html->link("Listele", array('controller' => 'cases', 'action' => 'index')); ?></li>
              <?php if ($user['User']['is_admin']) { ?>
                <li menu><?php echo $this->Html->link("Yeni oluştur", array('controller' => 'cases', 'action' => 'add')); ?></li>
              <?php } ?>
            </ul>
          </li>
          <?php if ($user['User']['is_admin']) { ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kuruluşlar <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li menu><?php echo $this->Html->link("Listele", array('controller' => 'customers', 'action' => 'index')); ?></li>
                <li menu><?php echo $this->Html->link("Yeni oluştur", array('controller' => 'customers', 'action' => 'add')); ?></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kullanıcılar <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li menu><?php echo $this->Html->link("Listele", array('controller' => 'users', 'action' => 'index')); ?></li>
                <li menu><?php echo $this->Html->link("Yeni oluştur", array('controller' => 'users', 'action' => 'add')); ?></li>
              </ul>
            </li>
          <?php } ?>
        <?php } ?>
      </ul>

      <?php if (isset($user) && !empty($user)) { ?>
        <ul class="nav navbar-nav navbar-right">
            <li menu>
              <?php echo $this->Html->link(Hash::get($user, 'User.mail') . ' <span class="caret"></span>', '#', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'escape' => false)); ?>
              <ul class="dropdown-menu">
                <li menu><?php echo $this->Html->link("Şifre değiştir", array('controller' => 'users', 'action' => 'change_password')); ?></li>
                <li role="separator" class="divider"></li>
                <li><?php echo $this->Html->link("Çıkış", array('controller' => 'users', 'action' => 'logout')); ?></li>
              </ul>
            </li>
        </ul>
      <?php } ?>
    </div>
  </div>
</nav>
