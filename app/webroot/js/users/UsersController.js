'use_strict';

/* CasesController */

CaseRecordSystem.controller('UsersController', ['$scope', '$sce', function($scope, $sce) {

  // Datatable fields
  $scope.tableFields = [
    {
      'title': 'Mail',
      'sort': 'User.mail',
      'getValue': function(data) {
        return '<a href="' + webroot + 'users/edit/' + data.User.id + '">' + $scope.highlight(data.User.mail) + '</a>';
      }
    },{
      'title': 'Kuruluş',
      'class': 'hidden-xs',
      'width': '60%',
      'sort': 'Customer.name',
      'getValue': function(data) {
        if (data.User.customer_id == null) return "Tanımlı değil";
        return '<a href="' + webroot + 'customers/edit/' + data.User.customer_id + '">' + $scope.highlight(data.Customer.name) + '</a>';
      }
    },{
      'title': 'Durum',
      'width': '5%',
      'getValue': function(data) {
        if (data.User.is_active) return '<span class="label label-success">Aktif</span>';
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
      case true: return "Aktif"; break;
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
      searchConditions['OR'].push({'User.mail like': '%' + $scope.searchText + '%'});
      searchConditions['OR'].push({'Customer.name like': '%' + $scope.searchText + '%'});
      conditions.push(searchConditions);
    }
    if ($scope._isActive !== undefined) conditions.push({'User.is_active': $scope._isActive});
    $scope.$broadcast('refresh-table', {'conditions': conditions}, changePage, refreshData);
  });


  // Trigger data-table when ready
  $scope.$on('data-table-ready', function(){
    $scope.filterChanged();
  });


}]);
