
'use strict';

/* Menu Directive */

CaseRecordSystem.directive('menu', ['$document', function($document) {
  return {
    scope: {

    },
    controller: function($scope){

      $scope.targetLink = null;

      $scope.$on('link-set', function(e, href){
        $scope.targetLink = href;
        if (!$scope.isActive()) return;
        $scope.element.addClass('active');
      });

      // Check if page is active
      $scope.isActive = function()
      {
        return $scope.targetLink == webroot + path;
      }

    },
    link: function($scope, element, attr) {
      $scope.element = element;
      $scope.$emit('link-set', angular.element(element).children('a').attr('href'));
    }
  };
}]);
