<?php $this->Html->script('users/UsersController.js', array('inline' => false)); ?>
<?php $this->Html->script('directive/bt_data_table/BtDataTable.js', array('inline' => false)); ?>
<div class="container" ng-controller="UsersController">
  <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <h4 class="panel-title pull-left hidden-xs" style="padding-top: 7.5px;">Kullanıcılar</h4>
      <div class="input-group col-sm-7 col-xs-12 pull-right">
        <span class="input-group-btn">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{getActiveValue()}} <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li ng-class="{active: isActive()}"><a href ng-click="setActive()">Hepsi</a></li>
            <li ng-class="{active: isActive(true)}"><a href ng-click="setActive(true)">Aktif</a></li>
            <li ng-class="{active: isActive(false)}"><a href ng-click="setActive(false)">Kapalı</a></li>
          </ul>
        </span>
        <input ng-enter="filterChanged()" type="text" ng-model="search" class="form-control" placeholder="Mail, Kuruluş"/>
        <span class="input-group-btn">
          <button class="btn btn-info" ng-click="filterChanged('clear')" type="button"><span class="glyphicon glyphicon-remove"></span></button>
          <button class="btn btn-primary" ng-click="filterChanged()" type="button"><span class="glyphicon glyphicon-search"></span></button>
        </span>
      </div>
    </div>
    <div class="panel-body" bt-data-table="get_users" bt-data-table-fields="tableFields">
    </div>
  </div>
</div>
