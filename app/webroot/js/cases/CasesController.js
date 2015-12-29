'use_strict';

/* CasesController */

CaseRecordSystem.controller('CasesController', ['$scope', '$sce', 'CaseRecordSystemService', function($scope, $sce, CaseRecordSystemService) {

  // Datatable fields
  $scope.tableFields = [
    {
      'title': 'Kart no',
      'sort': 'CaseRecord.no',
      'width': '10%',
      'getValue': function(data) {
        return '<bt-case-files bt-label="{{highlight(data.CaseRecord.no.toString())}}" bt-case="data.CaseRecord"></bt-case-files>';
      }
    }, {
        'title': 'Davacı',
        'class': 'hidden-xs',
        'width': '20%',
        'sort': 'CaseRecord.claimant_name',
        'getValue': function (data) {
            if (data.CaseRecord.claimant_id == null) return "Tanımlı değil";
            if (!userIsAdmin) return $scope.highlight(data.CaseRecord.claimant_name).toString();
            return '<a href="' + webroot + 'customers/edit/' + data.CaseRecord.claimant_id + '">' + $scope.highlight(data.CaseRecord.claimant_name) + '</a>';
        }
    },{
      'title': 'Davalı',
      'class': 'hidden-xs',
      'width': '20%',
      'sort': 'CaseRecord.defendant_name',
      'getValue': function(data) {
        if (data.CaseRecord.defendant_id == null) return "Tanımlı değil";
        if (!userIsAdmin) return $scope.highlight(data.CaseRecord.defendant_name).toString();
        return '<a href="' + webroot + 'customers/edit/' + data.CaseRecord.defendant_id + '">' + $scope.highlight(data.CaseRecord.defendant_name) + '</a>';
      }
    }, {
        'title': 'Dava konusu',
        'class': 'hidden-xs',
        'sort': 'CaseRecord.name',
        'width': '40%',
        'style': 'max-width: 470px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;',
        'getValue': function (data) {
            return '<bt-case-files bt-label="{{highlight(data.CaseRecord.name)}}" bt-case="data.CaseRecord"></bt-case-files>';
        }
    },{
      'title': 'Durum',
      'width': '5%',
      'getValue': function(data) {
        if (data.CaseRecord.is_active) return '<span class="label label-success">Açık</span>';
        return '<span class="label label-danger">Kapalı</span>';
      }
    }
  ];

  $scope._isActive = undefined;
  $scope._prevIsActive = undefined;
  $scope.setActive = function(state)
  {
    if ($scope._isActive == state) return;
    $scope._isActive = state;
    $scope.$emit('filter-change');
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
    if (command == "clear")
    {
      $scope.search = "";
      $scope._isActive = undefined;
    }
    $scope.$emit('filter-change');
  };

  // Catch Filter Changed
  $scope.$on('filter-change', function(e, filter, changePage, refreshData)
  {
    if ($scope.searchText === $scope.search && $scope._prevIsActive === $scope._isActive) return;
    $scope.searchText = $scope.search;
    $scope._prevIsActive = $scope._isActive;
    var conditions = [];
    if ($scope.searchText && $scope.searchText != "")
    {
      var searchConditions = {"OR": []};
      searchConditions['OR'].push({'CaseRecord.name like': '%' + $scope.searchText + '%'});
      searchConditions['OR'].push({'CaseRecord.defendant_name like': '%' + $scope.searchText + '%'});
      searchConditions['OR'].push({'CaseRecord.claimant_name like': '%' + $scope.searchText + '%'});
      searchConditions['OR'].push({'CaseRecord.no like': '%' + $scope.searchText + '%'});
      conditions.push(searchConditions);
    }
    if ($scope._isActive !== undefined) conditions.push({'CaseRecord.is_active': $scope._isActive});
    $scope.$broadcast('refresh-table', {'conditions': conditions}, changePage, refreshData);
  });


  // Trigger data-table when ready
  $scope.$on('data-table-ready', function(){
    $scope.filterChanged();
  });

}]);
