'use_strict';

/* CasesController */

CaseRecordSystem.controller('AddCaseController', ['$scope', '$sce', '$window', 'CaseRecordSystemService', function($scope, $sce, $window, CaseRecordSystemService) {

  // Link variables
  try
  {
    $scope.claimant = {name: $window.data.CaseRecord.claimant_name, id: $window.data.CaseRecord.claimant_id};
    $scope.defendant = {name: $window.data.CaseRecord.defendant_name, id: $window.data.CaseRecord.defendant_id};
  }
  catch (err)
  {
    $scope.claimant = $scope.defendant = {name: null, id: null};
  }

}]);
