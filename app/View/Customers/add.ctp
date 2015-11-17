<div class="container">
  <?php echo $this->Form->create("Customer", array('inputDefaults' => array('label' => false, 'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-block'))))); ?>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <?php echo $this->Form->input('Customer.name', array('label' => 'Kuruluş adı: ', 'class' => 'form-control')); ?>
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
