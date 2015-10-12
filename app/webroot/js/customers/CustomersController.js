'use_strict';

/* CasesController */

CaseRecordSystem.controller('CustomersController', ['$scope', '$sce', function($scope, $sce) {

  // Datatable fields
  $scope.tableFields = [
    {
      'title': 'Adı',
      'sort': 'Customer.name',
      'getValue': function(data) {
        return '<a href="' + webroot + 'cases/edit/' + data.Customer.name + '">' + $scope.highlight(data.Customer.name) + '</a>';
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
    if (!$scope.search) $scope.search = "";
    if (command == "clear")
    {
      $scope.search = "";
      return $scope.filterChanged();
    }
    if ($scope.searchText === $scope.search) return;
    $scope.searchText = $scope.search;
    var conditions = {};
    if ($scope.searchText != "")
    {
      conditions['OR'] = [];
      conditions['OR'].push({'Customer.name like': '%' + $scope.searchText + '%'});
    }
    $scope.$broadcast('refresh-table', {'conditions': conditions});
  }

}]);
