<?php echo $this->element('link_data'); ?>
<?php $this->Html->script('users/AddUserController.js?v1', array('inline' => false)); ?>
<?php $this->Html->script('directive/bt_customer_select/BtCustomerSelect.js?v1', array('inline' => false)); ?>
<div class="container" ng-controller="AddUserController">

  <?php
    echo $this->element('page_header', array(
      'title' => 'Kullanıcı oluştur',
      'icon' => 'fa-plus-square',
      'links' => array(
        'Tüm Kullanıcılar' => array('action' => 'index')
      )
    ));
  ?>

  <div class="col-xs-12">
    <?php echo $this->Form->create("User", array('autocomplete' => 'off', 'inputDefaults' => array('label' => false, 'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-block'))))); ?>
      <div class="row">
        <div class="col-sm-5">
          <div class="form-group">
            <input type="text" style="display:none"><input type="password" style="display:none">
            <?php echo $this->Form->input('User.mail', array('label' => 'Mail adresi: ', 'class' => 'form-control', 'autofocus' => 'autofocus')); ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="form-group">
            <?php echo $this->Form->input('User.password', array('label' => 'Şifre: ', 'class' => 'form-control')); ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label>
              <?php echo $this->Form->input('User.is_admin', array('ng-model' => 'isAdmin')); ?>
              &nbsp;Sistem yöneticisi<br/><small class="text-info" style="margin-left: 20px;">(Seçilmesi durumunda bağlı kuruluş varsa kaldırılır)</small>
            </label>
          </div>
        </div>
      </div>
      <div class="row" ng-show="isAdmin === false">
        <div class="col-sm-5">
          <label>Bağlı kuruluş :</label>
          <div class="input-group" style="margin-bottom:15px;">
            <?php echo $this->Form->input('User.customer_name', array('label' => false, 'class' => 'form-control', 'ng-value' => 'customer.name', 'readonly' => true)); ?>
            <?php echo $this->Form->input('User.customer_id', array('type' => 'hidden', 'ng-value' => 'customer.id')); ?>
            <span class="input-group-btn" bt-title="Davacı" bt-customer="customer" style="vertical-align: top;" bt-customer-select></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label>
              <?php echo $this->Form->input('User.is_active'); ?>
              Aktif
            </label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <hr size="1" />
          <button type="submit" class="btn btn-success"/><i class="fa fa-plus-circle"></i> Oluştur</button>
          &nbsp;veya&nbsp;
          <?php echo $this->History->goBack('İptal Et', array(), -1); ?>
        </div>
      </div>
    <?php echo $this->Form->end(); ?>
  </div>
</div>
