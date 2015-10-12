
'use strict';

/* Menu Directive */

CaseRecordSystem.directive('menu', ['$document', function($document) {
  return {
    controller: function($scope){

      $scope.targetLink = null;

      $scope.$on('link-set', function(e, href){
        $scope.targetLink = href;
        if (!$scope.isActive()) return;
        $scope.setActive();
      });

      $scope.setActive = function()
      {
        $scope.element.addClass('active');
        $scope.element.parent().closest('li').addClass('active');
        $scope.$emit('link-change', $scope.element);
      }

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
