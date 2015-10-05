'use strict';

/* Services */
var CaseRecordSystemService = angular.module('CaseRecordSystemService', ['ngResource']).config(function ($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
});

CaseRecordSystemService.factory('CaseRecordSystemService', ['$resource',
    function($resource){
      return $resource(webroot + ':controller/:action.json', {}, {
        get_cases: {method:'POST', params: {controller: "cases", action: "index"}, isArray: false}
      });
    }
]);
