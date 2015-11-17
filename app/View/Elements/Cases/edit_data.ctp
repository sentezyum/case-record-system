<?php echo $this->Form->create("CaseRecord", array('inputDefaults' => array('label' => false, 'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-block'))))); ?>
  <?php echo $this->Form->input('CaseRecord.id', array('type' => 'hidden')); ?>
  <div class="row">
    <div class="col-sm-4">
      <div class="form-group">
        <?php echo $this->Form->input('CaseRecord.no', array('label' => 'Büro kart no: ', 'class' => 'form-control', 'autofocus' => 'autofocus')); ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <?php echo $this->Form->input('CaseRecord.name', array('label' => 'Açıklama: ', 'class' => 'form-control')); ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-5">
      <label>Davacı :</label>
      <div class="input-group" style="margin-bottom:15px;">
        <?php echo $this->Form->input('CaseRecord.claimant_name', array('label' => false, 'class' => 'form-control', 'ng-value' => 'claimant.name', 'readonly' => true)); ?>
        <?php echo $this->Form->input('CaseRecord.claimant_id', array('type' => 'hidden', 'ng-value' => 'claimant.id')); ?>
        <span class="input-group-btn" bt-title="Davacı" bt-customer="claimant" style="vertical-align: top;" bt-customer-select></span>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-5">
      <label>Davalı :</label>
      <div class="input-group" style="margin-bottom:15px;">
        <?php echo $this->Form->input('CaseRecord.defendant_name', array('label' => false, 'class' => 'form-control', 'ng-value' => 'defendant.name', 'readonly' => true)); ?>
        <?php echo $this->Form->input('CaseRecord.defendant_id', array('type' => 'hidden', 'ng-value' => 'defendant.id')); ?>
        <span class="input-group-btn" bt-title="Davalı" bt-customer="defendant" style="vertical-align: top;" bt-customer-select></span>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4">
      <div class="form-group">
        <?php echo $this->Form->input('CaseRecord.unit', array('label' => 'Birim: ', 'class' => 'form-control')); ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4">
      <div class="form-group">
        <?php echo $this->Form->input('CaseRecord.basis_number', array('label' => 'Esas No: ', 'class' => 'form-control')); ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4">
      <div class="form-group">
        <label>
          <?php echo $this->Form->input('CaseRecord.is_active'); ?>
          Dosya Açık
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
