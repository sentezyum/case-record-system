'use_strict';

/* CasesController */

CaseRecordSystem.controller('EditCaseController', ['$scope', '$sce', '$window', 'CaseRecordSystemService', function($scope, $sce, $window, CaseRecordSystemService) {


  // Link variables
  try
  {
    $scope.claimant = {name: $window.data.CaseRecord.claimant_name, id: $window.data.CaseRecord.claimant_id};
    $scope.defendant = {name: $window.data.CaseRecord.defendant_name, id: $window.data.CaseRecord.defendant_id};
    $scope.caseDate = $window.data.CaseRecord ? $window.data.CaseRecord.date : moment().format("YYYY-MM-DD");
    $scope.caseFileDate = $window.data.CaseRecordFile ? $window.data.CaseRecordFile.date : "";
    $scope.isActive = $window.data.CaseRecord ? $window.data.CaseRecord.is_active : false;
  }
  catch (err)
  {
    $scope.claimant = $scope.defendant = {name: null, id: null};
    $scope.caseDate = moment().format("YYYY-MM-DD");
    $scope.isActive = false;
  }

}]);
