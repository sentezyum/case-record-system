'use strict';

/* btModalProduct Directive */

CaseRecordSystem.directive('btDataTable', function (){
  return {
    restrict: 'A',
    controller: ['$attrs', '$scope', 'CaseRecordSystemService', function($attrs, $scope, CaseRecordSystemService) {
      $scope.btDataTable = $attrs.btDataTable;
      // check service has method
      if (!$scope.btDataTable || !CaseRecordSystemService.hasOwnProperty($scope.btDataTable))
      {
        console.error('Service method ' + $scope.btDataTable + ' not found!');
        return;
      }

      $scope.params = {};
      $scope.header = {};
      $scope.data = [];
      $scope.dataLoading = false;

      $scope.getData = function()
      {

        $scope.dataLoading = true;
        $scope.data = [];
        CaseRecordSystemService[$scope.btDataTable]($scope.getParams(), function(result){
          $scope.dataLoading = false;
          $scope.header = result.header;
          console.log($scope.header);
          $scope.data = result.data;
        });
      };

      $scope.isLoading = function()
      {
        return $scope.dataLoading;
      }

      $scope.getParams = function()
      {
        return $scope.header;
      }

      $scope.sort = function(fieldName)
      {
        if (!$scope.header.order) return;
        var dir = $scope.header.order[fieldName] == 'asc' ? 'desc' : 'asc'
        $scope.header.order = {};
        $scope.header.order[fieldName] = dir;
        $scope.getData();
      }

      $scope.getHeader = function(fieldName, title)
      {
        var header = "<a href='JavaScript:void(0);'>" + title + "</a>";
        if ($scope.header.order && $scope.header.order.hasOwnProperty(fieldName)) header = header + " <i class='fa fa-sort-" + ($scope.header.order[fieldName] == 'asc' ? 'asc' : 'desc') + "'></i>";
        return header;
      }

      $scope.getData();
    }]
  };
});
