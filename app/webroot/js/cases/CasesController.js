'use_strict';

/* CasesController */

CaseRecordSystem.controller('CasesController', ['$scope', '$sce', 'CaseRecordSystemService', function($scope, $sce, CaseRecordSystemService) {

  // Datatable fields
  $scope.tableFields = [
    {
      'title': 'Açıklama',
      'sort': 'CaseRecord.name',
      'getValue': function(data) {
        return '<a href="' + webroot + 'cases/edit/' + data.CaseRecord.id + '">' + $scope.highlight(data.CaseRecord.name) + '</a>';
      }
    },{
      'title': 'Davalı',
      'class': 'hidden-xs',
      'width': '20%',
      'sort': 'CaseRecord.defendant_name',
      'getValue': function(data) {
        if (data.CaseRecord.defendant_id == null) return $scope.highlight(data.CaseRecord.defendant_name);
        return '<a href="' + webroot + 'customers/edit/' + data.CaseRecord.defendant_id + '">' + $scope.highlight(data.CaseRecord.defendant_name) + '</a>';
      }
    },{
      'title': 'Davacı',
      'class': 'hidden-xs',
      'width': '20%',
      'sort': 'CaseRecord.claimant_name',
      'getValue': function(data) {
        if (data.CaseRecord.claimant_id == null) return $scope.highlight(data.CaseRecord.claimant_name);
        return '<a href="' + webroot + 'customers/edit/' + data.CaseRecord.claimant_id + '">' + $scope.highlight(data.CaseRecord.claimant_name) + '</a>';
      }
    },{
      'title': 'Durum',
      'width': '5%',
      'getValue': function(data) {
        if (data.CaseRecord.is_active) return '<span ng-show="c.CaseRecord.is_active" class="label label-success">Açık</span>';
        return '<span ng-show="!c.CaseRecord.is_active" class="label label-danger">Kapalı</span>';
      }
    }
  ];

  $scope._isActive = undefined;
  $scope._prevIsActive = undefined;
  $scope.setActive = function(state)
  {
    if ($scope._isActive == state) return;
    $scope._isActive = state;
    $scope.filterChanged();
  }
  $scope.isActive = function(state)
  {
    return $scope._isActive === state;
  }
  $scope.getActiveValue = function()
  {
    switch ($scope._isActive)
    {
      case undefined: return "Hepsi"; break;
      case true: return "Açık"; break;
      case false: return "Kapalı"; break;
      default: return "HATA!"; break;
    }
  }

  // Search highlight
  $scope.searchText = "";
  $scope.highlight = function(text) {
    if (!$scope.searchText) return $sce.trustAsHtml(text);
    return $sce.trustAsHtml(text.replace(new RegExp($scope.searchText, 'gi'), '<span class="highlight">$&</span>'));
  };

  $scope.filterChanged = function(command)
  {
    if (!$scope.search) $scope.search = "";
    if (command == "clear")
    {
      $scope.search = "";
      $scope._isActive = undefined;
      return $scope.filterChanged();
    }
    if ($scope.searchText === $scope.search && $scope._prevIsActive === $scope._isActive) return;
    $scope.searchText = $scope.search;
    $scope._prevIsActive = $scope._isActive;
    var conditions = {};
    if ($scope.searchText != "")
    {
      conditions['OR'] = [];
      conditions['OR'].push({'CaseRecord.name like': '%' + $scope.searchText + '%'});
      conditions['OR'].push({'CaseRecord.defendant_name like': '%' + $scope.searchText + '%'});
      conditions['OR'].push({'CaseRecord.claimant_name like': '%' + $scope.searchText + '%'});
    }
    if ($scope._isActive !== undefined) conditions['CaseRecord.is_active'] = $scope._isActive;
    $scope.$broadcast('refresh-table', {'conditions': conditions});
  };

}]);
