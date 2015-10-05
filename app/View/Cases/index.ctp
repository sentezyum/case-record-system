<?php $this->Html->script('directive/bt_data_table/BtDataTable.js', array('inline' => false)); ?>
<div class="container">
  <div class="row">
    <div class="col-sm-12" bt-data-table="get_cases">
      <table class="table table-striped">
        <thead>
          <tr>
            <th ng-click="sort('CaseRecord.name')" ng-bind-html="getHeader('CaseRecord.name', 'Açıklama')">Açıklama</th>
            <th class="hidden-xs" ng-click="sort('CaseRecord.defendant_name')" ng-bind-html="getHeader('CaseRecord.defendant_name', 'Davalı')">Davalı</th>
            <th class="hidden-xs">Davacı</th>
            <th>Durum</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="c in data">
            <td>
              <a href="{{webroot + 'cases/view/' + c.CaseRecord.id}}">{{::c.CaseRecord.name}}</a>
            </td>
            <td class="hidden-xs">
              <a ng-if="c.CaseRecord.defendant_id != null" href="{{webroot + 'customers/view/' + c.CaseRecord.defendant_id}}">{{::c.CaseRecord.defendant_name}}</a>
              <span ng-if="c.CaseRecord.defendant_id == null">{{::c.CaseRecord.defendant_name}}</span>
            </td>
            <td class="hidden-xs">
              <a ng-if="c.CaseRecord.claimant_id != null" href="{{webroot + 'customers/view/' + c.CaseRecord.claimant_id}}">{{::c.CaseRecord.defendant_name}}</a>
              <span ng-if="c.CaseRecord.claimant_id == null">{{::c.CaseRecord.claimant_name}}</span>
            </td>
            <td>
              <span ng-show="c.CaseRecord.is_active" class="label label-success">Açık</span>
              <span ng-show="!c.CaseRecord.is_active" class="label label-danger">Kapalı</span>
            </td>
          </tr>
          <tr ng-if="isLoading()">
            <td colspan="4">Yükleniyor</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
