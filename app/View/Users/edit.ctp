<?php echo $this->element('link_data'); ?>
<?php $this->Html->script('users/AddUserController.js?v1', array('inline' => false)); ?>
<?php $this->Html->script('directive/bt_customer_select/BtCustomerSelect.js?v1.1', array('inline' => false)); ?>
<div class="container" ng-controller="AddUserController">

  <?php
    echo $this->element('page_header', array(
      'title' => 'Kullanıcı düzenle',
      'icon' => 'fa-pencil-square-o',
      'links' => array(
        'Tüm Kullanıcılar' => array('action' => 'index'),
        'Yeni Oluştur' => array('action' => 'add')
      )
    ));
  ?>

  <div class="col-xs-12">
    <?php echo $this->Form->create("User", array('inputDefaults' => array('label' => false, 'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-block'))))); ?>
      <?php echo $this->Form->input('User.id', array('type' => 'hidden')); ?>
      <div class="row">
        <div class="col-sm-5">
          <div class="form-group">
            <?php echo $this->Form->input('User.mail', array('label' => 'Mail adresi: ', 'class' => 'form-control', 'autofocus' => 'autofocus')); ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="form-group">
            <label>
              <?php echo $this->Form->input('User.change_password', array('type' => 'checkbox', 'ng-model' => 'changePassword')); ?>
              &nbsp;Şifre değiştir<br/><small class="text-info" style="margin-left: 20px;">(Seçilmesi durumunda şifre değiştirme kutusu görünecektir)</small>
            </label>
          </div>
        </div>
      </div>
      <div class="row" ng-if="changePassword == true">
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
          <button type="submit" class="btn btn-success"/><i class="fa fa-floppy-o"></i> Güncelle</button>
        </div>
      </div>
    <?php echo $this->Form->end(); ?>
  </div>
</div>
