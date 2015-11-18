<?php $this->Html->script('customers/CustomersController.js?v1', array('inline' => false)); ?>
<?php $this->Html->script('directive/bt_data_table/BtDataTable.js?v1', array('inline' => false)); ?>
<div class="container" ng-controller="CustomersController">
  <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <h4 class="panel-title pull-left hidden-xs" style="padding-top: 7.5px;">Kuruluşlar</h4>
      <div class="input-group col-sm-7 col-xs-12 pull-right">
        <input ng-enter="filterChanged()" type="text" ng-model="search" class="form-control" placeholder="Kuruluş adı"/>
        <span class="input-group-btn">
          <button class="btn btn-info" ng-click="filterChanged('clear')" type="button"><span class="glyphicon glyphicon-remove"></span></button>
          <button class="btn btn-primary" ng-click="filterChanged()" type="button"><span class="glyphicon glyphicon-search"></span></button>
        </span>
      </div>
    </div>
    <div class="panel-body" bt-data-table="get_customers" bt-data-table-fields="tableFields">
    </div>
  </div>
</div>
