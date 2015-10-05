'use strict';

/* App Module */
var CaseRecordSystem = angular.module('CaseRecordSystem', [
  'CaseRecordSystemService',
  'ngSanitize'
]);

moment.locale('tr');

CaseRecordSystem.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.ngEnter);
                });
                event.preventDefault();
            }
        });
    };
});
