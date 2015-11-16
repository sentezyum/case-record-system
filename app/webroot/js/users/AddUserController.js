'use_strict';

/* CasesController */

CaseRecordSystem.controller('AddUserController', ['$scope', '$window', function($scope, $window) {

  $scope.isAdmin = $window.data.User ? $window.data.User.is_admin == "1" : true
  $scope.customer = $window.data.User ? {name: $window.data.User.customer_name, id: $window.data.User.customer_id} : {name: null, id: null};
  $scope.changePassword = $window.data.User ? $window.data.User.change_password == "1" : false;

}]);
