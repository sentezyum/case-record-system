'use_strict';

/* CasesController */

CaseRecordSystem.controller('CustomersController', ['$scope', '$sce', function($scope, $sce) {

  // Datatable fields
  $scope.tableFields = [
    {
      'title': 'Adı',
      'sort': 'Customer.name',
      'getValue': function(data) {
        return '<a href="' + webroot + 'customers/edit/' + data.Customer.id + '">' + $scope.highlight(data.Customer.name) + '</a>';
      }
    }
  ];

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
    var conditions = [];
    if ($scope.searchText && $scope.searchText != "")
    {
      var searchConditions = {"OR": []};
      searchConditions['OR'].push({'Customer.name like': '%' + $scope.searchText + '%'});
      conditions.push(searchConditions);
    }
    $scope.$broadcast('refresh-table', {'conditions': conditions}, changePage, refreshData);
  });


  // Trigger data-table when ready
  $scope.$on('data-table-ready', function(){
    $scope.filterChanged();
  });

}]);
