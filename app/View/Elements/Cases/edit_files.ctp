<table class="table">
  <thead>
    <th>Evrak Adı</th>
    <th>Açıklama</th>
  </thead>
  <tbody>
    <?php foreach ($caseRecordFiles as $key => $caseRecordFile) { ?>
      <tr>
        <td><a href="<?php echo $this->webroot . $caseRecordFile['CaseRecordFile']['file_name']; ?>" target="_new"><?php echo $caseRecordFile['CaseRecordFile']['name']; ?></a></td>
        <td><?php echo $caseRecordFile['CaseRecordFile']['description']; ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<div class="well">
  <div class="page-header" style="margin-top:0px;">
    <h4>Yeni dava dosyası ekle</h4>
  </div>
  <?php echo $this->Form->create("CaseRecordFile", array('enctype' => 'multipart/form-data', 'inputDefaults' => array('label' => false, 'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-block'))))); ?>
    <?php echo $this->Form->input('CaseRecordFile.case_record_id', array('type' => 'hidden', 'value' => $this->request->data['CaseRecord']['id'])); ?>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <?php echo $this->Form->input('CaseRecordFile.name', array('label' => 'Evrak adı: ', 'class' => 'form-control', 'autofocus' => 'autofocus')); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <?php echo $this->Form->input('CaseRecordFile.file_name', array('label' => 'Dosya: ', 'class' => null, 'type' => 'file')); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <?php echo $this->Form->input('CaseRecordFile.description', array('label' => 'Açıklama: ', 'class' => 'form-control')); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <button type="submit" class="btn btn-success"/><i class="fa fa-plus-square"></i> Ekle</button>
      </div>
    </div>
  <?php echo $this->Form->end(); ?>
</div>
