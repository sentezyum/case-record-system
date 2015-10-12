'use strict';

/* CaseRecordSystemController Controller */

CaseRecordSystem.controller('CaseRecordSystemController', function ($scope, $sce, CaseRecordSystemService)
{
  $scope.breadCrumb = [];
  $scope.$on('link-change', function(e, element) {
    $scope.breadCrumb = [];
    $scope.breadCrumb.push({title: element.children("a").text(), link: false});
    angular.forEach(element.parents("li"), function(_element){
      if (_element) $scope.breadCrumb.push({title: $(_element).children("a").text().trim(), link: $(_element).children("a").attr('href')});
    });
    $scope.breadCrumb = $scope.breadCrumb.reverse();
  });
});
