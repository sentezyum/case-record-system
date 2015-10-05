<div class="container">
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
        <div class="form-group">
          <?php echo $this->Form->input('CaseRecord.claimant_name', array('label' => 'Davacı: ', 'class' => 'form-control')); ?>
          <?php echo $this->Form->input('CaseRecord.claimant_id', array('type' => 'hidden')); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-5">
        <div class="form-group">
          <?php echo $this->Form->input('CaseRecord.defendant_name', array('label' => 'Davalı: ', 'class' => 'form-control')); ?>
          <?php echo $this->Form->input('CaseRecord.defendant_id', array('type' => 'hidden')); ?>
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
        <button type="submit" class="btn btn-success"/>Kaydet</button>
        &nbsp;veya&nbsp;
        <?php echo $this->Html->link('İptal Et', array('action' => 'index')); ?>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>
</div>
