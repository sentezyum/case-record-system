'use strict';

/* btModalSelect Directive */

CaseRecordSystem.directive('btCaseFiles', function (){
  return {
    restrict: 'AE',
    scope: {
      btCase: "=",
      btLabel: "@"
    },
    templateUrl: webroot + 'js/directive/bt_case_files/bt-case-files.html',
    controller: ['$scope', '$sce', 'CaseRecordSystemService', function($scope, $sce, CaseRecordSystemService){

      // Hold customers
      $scope.caseRecord = null;

      $scope.tab = 'general';

      $scope.userIsAdmin = userIsAdmin;

      $scope.getEditLink = function()
      {
        if ($scope.btCase) return webroot + 'cases/edit/' + $scope.btCase.id;
        return "";
      };
      $scope.getFileLink = function(file)
      {
        return webroot + file.file_name;
      };

      // Option Logic
      $scope._options = {};
      $scope.getOption = function(key)
      {
        return $scope._options[key];
      };
      $scope.setOption = function(key, value)
      {
        return $scope._options[key] = value;
      };

      // Loading Logic
      $scope._loading = {};
      $scope.loading = function(key)
      {
        $scope._loading[key] = true;
      };
      $scope.loaded = function(key)
      {
        $scope._loading[key] = false;
      };
      $scope.isLoading = function(key)
      {
        return $scope._loading[key] === true;
      }

      // Bootstrap
      $scope._bootstrap = function(callback)
      {
        // Options
        $scope.setOption('default_item_limit', 10);
        $scope.setOption('item_limit', $scope.getOption('default_item_limit'));

        // Defaults
        $scope.fileNameSearch = "";

        // Call Files
        if ($scope.caseRecord == null || !$scope.caseRecord.CaseRecord)
        {
          $scope.loading('case');
          CaseRecordSystemService.view_case({CaseRecord: {id: $scope.btCase.id}}, function(caseRecord){
            $scope.caseRecord = caseRecord;
            $scope.loaded('case');
            if (typeof callback == "function") callback();
          });
          return;
        }

        if (typeof callback == "function") callback();
      };

      // Search highlight
      $scope.highlight = function(text) {
        if (!$scope.fileNameSearch) return $sce.trustAsHtml(text);
        return $sce.trustAsHtml(text.replace(new RegExp($scope.fileNameSearch, 'gi'), '<span class="highlight">$&</span>'));
      };

      // Return filtered customer count
      $scope.filteredItemCount = function()
      {
        if (!$scope.caseRecord.files) return 0;
        var results = $scope.caseRecord.CaseRecordFile;
        if ($scope.fileNameSearch != "") results = _.filter(results, function(e){ return e.name.toLocaleLowerCase().indexOf($scope.fileNameSearch.toLocaleLowerCase()) > -1; });
        return results.length - $scope.getOption('item_limit');
      };

      // Show more data
      $scope.showMore = function()
      {
        $scope.setOption('item_limit', $scope.getOption('item_limit') + $scope.getOption('default_item_limit'));
      };

      // Open modal
      $scope.open = function()
      {
        $scope._bootstrap(function(){
          $scope.modalElement.modal('show');
        });
      };

      // Close modal
      $scope.close = function()
      {
        $scope.modalElement.modal('hide');
      };

    }],
    link: function($scope, element, attr) {
      var modal = element.find('.modal').modal({show: false});
      modal.appendTo("body");

      $scope.modalElement = modal;
    }
  };
});
