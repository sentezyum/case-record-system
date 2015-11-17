<div class="container">
  <?php echo $this->Form->create("Customer", array('inputDefaults' => array('label' => false, 'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-block'))))); ?>
    <?php echo $this->Form->input('Customer.id', array('type' => 'hidden')); ?>
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
        <button type="submit" class="btn btn-success"/><i class="fa fa-floppy-o"></i> Güncelle</button>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>
</div>
