'use_strict';

/* CasesController */

CaseRecordSystem.controller('ChangeUserPasswordController', ['$scope', function($scope) {

  $scope.new_password_1 = "";
  $scope.new_password_2 = "";
  $scope.old_password = "";
  $scope.allowSubmit = function()
  {
    if ($scope.old_password == "" || $scope.new_password_1 == "" || $scope.new_password_2 == "") return false;
    return $scope.isMatch();
  }
  $scope.isMatch = function()
  {
    if ($scope.new_password_1 == "" && $scope.new_password_2 == "") return undefined;
    return $scope.new_password_1 === $scope.new_password_2;
  }
  $scope.submitting = false;

}]);
