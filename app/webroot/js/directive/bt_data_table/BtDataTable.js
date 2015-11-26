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
       var header = dataTableField.title;
       if ($scope.header.order && $scope.header.order.hasOwnProperty(dataTableField.sort)) header = header + " <i class='fa fa-sort-" + ($scope.header.order[dataTableField.sort] == 'asc' ? 'asc' : 'desc') + "'></i>";
       return "<div class='table-header'>" + header + "</div>";
     }

     // Get page params
     $scope.header = {page: 1, count: 0, limit: 15};
     $scope.getParams = function()
     {
       return $scope.header;
     }

     // Remote Call
     $scope.remoteOptions = {};
     $scope.$on('refresh-table', function(e, header, changePage, refreshData){
       if (header) $scope.remoteOptions = header;
       if (changePage === false)
         $scope.pageChanged($scope.header.page, refreshData);
       else
         $scope.pageChanged(1, refreshData);
     });

     // General get data
     $scope.data = [];
     $scope.getData = function(refreshData)
     {
       if ($scope.remoteOptions && $scope.remoteOptions.conditions) $scope.header.conditions = $scope.remoteOptions.conditions;
       refreshData = typeof refreshData != "boolean" ? true : refreshData;
       if (refreshData === true) $scope.data = [];
       $scope.dataLoading = true;
       CaseRecordSystemService[$scope.btDataTable]($scope.getParams(), function(result){
         $scope.dataLoading = false;
         $scope.header = result.header;
         $scope.deletingIndex = null;
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
     $scope.pageChanged = function(page, refreshData)
     {
       if (!$scope.header.page) return;
       $scope.header.page = page;
       $scope.getData(refreshData);
     }

     // Send data-table-ready
     $scope.$emit('data-table-ready');

     $scope.deletingIndex = null;
     $scope.isDeleting = function(index)
     {
       return index == $scope.deletingIndex;
     };
     $scope.$on('row-delete', function(e, index){
       $scope.deletingIndex = index;
     });

   }]
 };
});

CaseRecordSystem.directive('btDataTableField', function ($compile){
 return {
   restrict: 'A',
   scope: {
     btData: '=',
     btValueGetter: '='
   },
   link: function($scope, element, attrs) {
     var el;
     var tpl = $scope.btValueGetter($scope.btData);
     var _index = $scope.$parent.$parent.$index;
     tpl = tpl.replace(/data/gi, "data[" + _index + "]");
     if (!$scope.$parent.$parent.$parent.$parent.data) $scope.$parent.$parent.$parent.$parent.data = [];
     $scope.btData.index = _index;
     $scope.$parent.$parent.$parent.$parent.data[_index] = $scope.btData;
     el = $compile("<span>" + tpl + "</span>")($scope.$parent.$parent.$parent.$parent);
     element.html("");
     element.append(el);
   }
 };
});
