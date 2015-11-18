<?php echo $this->element('link_data'); ?>
<?php $this->Html->script('cases/AddCaseController.js?v1', array('inline' => false)); ?>
<?php $this->Html->script('directive/bt_customer_select/BtCustomerSelect.js?v1.1', array('inline' => false)); ?>
<div class="container" ng-controller="AddCaseController">

  <?php
    echo $this->element('page_header', array(
      'title' => 'Dava düzenle',
      'icon' => 'fa-pencil-square-o',
      'links' => array(
        'Tüm Davalar' => array('action' => 'index'),
        'Yeni Oluştur' => array('action' => 'add')
      )
    ));
  ?>

  <div class="col-xs-12">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" style="margin-bottom: 20px;">
      <li role="presentation" class="active">
        <a href="#data" aria-controls="data" role="tab" data-toggle="tab">Genel</a>
      </li>
      <li role="presentation">
        <a href="#files" aria-controls="files" role="tab" data-toggle="tab">Dosyalar</a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Data Edit -->
      <div role="tabpanel" class="tab-pane active" id="data">
        <?php echo $this->element('Cases/edit_data'); ?>
      </div>
      <!-- Files Edit -->
      <div role="tabpanel" class="tab-pane" id="files">
        <?php echo $this->element('Cases/edit_files'); ?>
      </div>
    </div>
  </div>
</div>
