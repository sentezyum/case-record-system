<?php $this->Html->script('users/AddUserController.js', array('inline' => false)); ?>
<?php $this->Html->script('directive/bt_customer_select/BtCustomerSelect.js', array('inline' => false)); ?>
<div class="container" ng-controller="AddUserController">
  <script>
    window.data = <?php echo json_encode($this->request->data); ?>;
  </script>
  <?php echo $this->Form->create("User", array('inputDefaults' => array('label' => false, 'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-block'))))); ?>
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
        <button type="submit" class="btn btn-success"/>Kaydet</button>
        &nbsp;veya&nbsp;
        <?php echo $this->History->goBack('İptal Et', array(), -1); ?>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>
</div>
