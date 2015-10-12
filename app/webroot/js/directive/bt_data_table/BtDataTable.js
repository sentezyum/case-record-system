'use strict';

CaseRecordSystem.config(function(paginationTemplateProvider) {
    paginationTemplateProvider.setPath(webroot + 'js/directive/bt_data_table/paginate-template.html');
});

/* btModalProduct Directive */

CaseRecordSystem.directive('btDataTable', function (){
  return {
    restrict: 'A',
    scope: {
      btDataTableFields: '='
    },
    templateUrl: webroot + 'js/directive/bt_data_table/bt-data-table.html',
    controller: ['$attrs', '$scope', 'CaseRecordSystemService', function($attrs, $scope, CaseRecordSystemService) {
      // Set datatable source
      $scope.btDataTable = $attrs.btDataTable;

      // Check service has method
      if (!$scope.btDataTable || !CaseRecordSystemService.hasOwnProperty($scope.btDataTable)) return console.error('Service method ' + $scope.btDataTable + ' not found!');

      // On sort click
      $scope.sort = function(dataTableField)
      {
        if (!$scope.header.order || !dataTableField.sort) return;
        var dir = ($scope.header.order[dataTableField.sort] == 'asc' ? 'desc' : 'asc');
        $scope.header.order = {};
        $scope.header.order[dataTableField.sort] = dir;
        $scope.getData();
      }

      // Get header text
      $scope.getHeader = function(dataTableField)
      {
        if (!dataTableField.sort) return dataTableField.title;
        var header = "<a href='JavaScript:void(0);'>" + dataTableField.title + "</a>";
        if ($scope.header.order && $scope.header.order.hasOwnProperty(dataTableField.sort)) header = header + " <i class='fa fa-sort-" + ($scope.header.order[dataTableField.sort] == 'asc' ? 'asc' : 'desc') + "'></i>";
        return "<div class='table-header'>" + header + "</div>";
      }

      // Get page params
      $scope.header = {page: 1, count: 0, limit: 50};
      $scope.getParams = function()
      {
        return $scope.header;
      }

      $scope.$on('refresh-table', function(e, header){
        if (header && header.conditions) $scope.header.conditions = header.conditions;
        $scope.pageChanged(1);
      });

      // General get data
      $scope.data = [];
      $scope.getData = function()
      {
        $scope.dataLoading = true;
        $scope.data = [];
        CaseRecordSystemService[$scope.btDataTable]($scope.getParams(), function(result){
          $scope.dataLoading = false;
          $scope.header = result.header;
          $scope.data = result.data;
        });
      };

      // Get value from data with dataTableField
      $scope.getValue = function(data, dataTableField)
      {
        return dataTableField.getValue(data);
      }

      // Data is loading flag
      $scope.dataLoading = false;
      $scope.isLoading = function()
      {
        return $scope.dataLoading;
      }

      // Change page
      $scope.pageChanged = function(page)
      {
        if (!$scope.header.page) return;
        $scope.header.page = page;
        $scope.getData();
      }

      $scope.getData();
    }]
  };
});
