<?php $this->Html->script('users/ChangeUserPasswordController.js', array('inline' => false)); ?>
<div class="container" ng-controller="ChangeUserPasswordController">
  <?php echo $this->Form->create("User", array('inputDefaults' => array('label' => false, 'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-block'))))); ?>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <?php echo $this->Form->input('User.password', array('label' => 'Eski şifre: ', 'class' => 'form-control', 'ng-model' => 'old_password', 'autofocus' => 'autofocus')); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-5">
        <hr />
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group" ng-class="{'has-warning': isMatch() === false}">
          <?php echo $this->Form->input('User.password_new', array('label' => 'Yeni şifre: ', 'type' => 'password', 'class' => 'form-control', 'ng-model' => 'new_password_1', 'autofocus' => 'autofocus')); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group" ng-class="{'has-warning': isMatch() === false}">
          <?php echo $this->Form->input('User.password_new_control', array('label' => 'Tekrar: ', 'type' => 'password', 'class' => 'form-control', 'ng-model' => 'new_password_2', 'autofocus' => 'autofocus')); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-5">
        <hr />
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <button type="submit" class="btn btn-success" ng-disabled="!allowSubmit()" data-loading-text="Lütfen Bekleyin..." onclick="if($(this).closest('form')[0].checkValidity()) $(this).button('loading');"/>Değiştir</button>
        &nbsp;veya&nbsp;
        <?php echo $this->Html->link('İptal Et', '/'); ?>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>
</div>
