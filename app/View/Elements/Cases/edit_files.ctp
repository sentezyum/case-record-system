<table class="table">
  <thead>
    <th style="width:10%;">Tarih</th>
    <th style="width:35%;">Evrak Adı</th>
    <th style="width:50%;">Açıklama</th>
    <th style="width:5%;">&nbsp;</th>
  </thead>
  <tbody>
    <?php foreach ($caseRecordFiles as $key => $caseRecordFile) { ?>
      <tr>
        <td><?php echo $this->Time->format('d.m.Y', $caseRecordFile['CaseRecordFile']['date']); ?></td>
        <td><a href="<?php echo $this->webroot . $caseRecordFile['CaseRecordFile']['file_name']; ?>" target="_new"><?php echo $caseRecordFile['CaseRecordFile']['name']; ?></a></td>
        <td class="elipsis-text word-break-text"><?php echo $caseRecordFile['CaseRecordFile']['description']; ?></td>
        <td><?php echo $this->Html->link('Kaldır', array('action' => 'delete_file', $caseRecordFile['CaseRecordFile']['id'])); ?></td>
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
      <div class="col-sm-3">
        <label>Tarih :</label>
        <div class="input-group" style="margin-bottom:15px;">
          <?php echo $this->Form->input('CaseRecordFile.date', array('type' => 'text', 'readonly' => 'readonly', 'label' => false, 'class' => 'form-control', 'uib-datepicker-popup' => 'yyyy-MM-dd', 'is-open' => 'dateFileState', 'ng-model' => 'caseFileDate' )); ?>
          <span class="input-group-btn">
            <button type="button" class="btn btn-default" ng-click="dateFileState = true"><i class="glyphicon glyphicon-calendar"></i></button>
          </span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <?php echo $this->Form->input('CaseRecordFile.name', array('label' => 'Evrak adı (Max.' . ini_get("upload_max_filesize") . '): ', 'class' => 'form-control', 'autofocus' => 'autofocus')); ?>
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
