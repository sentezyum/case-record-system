'use strict';

/* Services */
var CaseRecordSystemService = angular.module('CaseRecordSystemService', ['ngResource']).config(function ($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';

    var old_transformResponse = $httpProvider.defaults.transformResponse;
    $httpProvider.defaults.transformResponse = function(data, parser, statusCode) {
        var retVal = old_transformResponse[0].apply(this, arguments);
        if (statusCode == 401) {
          BootstrapDialog.show({
            title: 'Zaman Aşımı',
            message: 'Oturumunuz zaman aşımına uğradı. Lütfen tekrar giriş yapınız.',
            buttons: [{
                label: 'Giriş',
                type: BootstrapDialog.TYPE_DANGER,
                size: BootstrapDialog.SIZE_SMALL,
                cssClass: 'btn-primary',
                action: function(dialog) {
                    window.location = webroot;
                }
            }]
          });
          return undefined;
        }
        if (statusCode != 200) {
          BootstrapDialog.show({
            title: 'Hata',
            message: retVal.message ? retVal.message : "Belirsiz bir hata meydana geldi. Lütfen tekrar deneyiniz.",
            buttons: [{
                label: 'Tamam',
                type: BootstrapDialog.TYPE_DANGER,
                cssClass: 'btn-primary'
            }]
          });
          return undefined;
        }
        return retVal;
    };
});

CaseRecordSystemService.factory('CaseRecordSystemService', ['$resource',
    function($resource){
      return $resource(webroot + ':controller/:action.json', {}, {
        get_cases: {method:'POST', params: {controller: "cases", action: "index"}, isArray: false},
        get_customers: {method:'POST', params: {controller: "customers", action: "index"}, isArray: false}
      });
    }
]);
