'use strict';

/* Services */
var CaseRecordSystemService = angular.module('CaseRecordSystemService', ['ngResource']).config(function ($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
});

CaseRecordSystemService.factory('CaseRecordSystemService', ['$resource',
    function($resource){
      return $resource(webroot + '/:controller/:action.json', {}, {
        reform_products: {method:'POST', params: {plugin: "platinmarket", controller: "products", action: "index"}, isArray: true}
      });
    }
]);
