'use strict';

/* btModalSelect Directive */

CaseRecordSystem.directive('btCustomerSelect', function (){
  return {
    restrict: 'AE',
    scope: {
      btTitle: "@",
      btLock: "=",
      btCustomer: "="
    },
    templateUrl: webroot + 'js/directive/bt_customer_select/bt-customer-select.html',
    controller: ['$scope', '$sce', 'CaseRecordSystemService', function($scope, $sce, CaseRecordSystemService){

      // Hold customers
      $scope.customers = null;

      // Option Logic
      $scope._options = {};
      $scope.getOption = function(key)
      {
        return $scope._options[key];
      };
      $scope.setOption = function(key, value)
      {
        return $scope._options[key] = value;
      };

      // Loading Logic
      $scope._loading = {};
      $scope.loading = function(key)
      {
        $scope._loading[key] = true;
      };
      $scope.loaded = function(key)
      {
        $scope._loading[key] = false;
      };
      $scope.isLoading = function(key)
      {
        return $scope._loading[key] === true;
      }

      // Get lock state
      $scope.isLocked = function()
      {
        return $scope.btLock === true || $scope.getOption('internal_lock') === true;
      };

      // Bootstrap
      $scope._bootstrap = function(callback)
      {
        // Options
        $scope.setOption('default_item_limit', 10);
        $scope.setOption('item_limit', $scope.getOption('default_item_limit'));
        $scope.setOption('internal_lock', false);

        // Defaults
        $scope.customerSearchText = "";
        $scope.selectedCustomer = null;

        // Call Customers
        if ($scope.customers == null)
        {
          $scope.loading('customers');
          CaseRecordSystemService.all_customer(function(customers){
            $scope.customers = customers;
            $scope.loaded('customers');
            if (typeof callback == "function") callback();
          });
          return;
        }

        if (typeof callback == "function") callback();
      };

      // Search highlight
      $scope.highlight = function(text) {
        if (!$scope.customerSearchText) return $sce.trustAsHtml(text);
        return $sce.trustAsHtml(text.replace(new RegExp($scope.customerSearchText, 'gi'), '<span class="highlight">$&</span>'));
      };

      // Return filtered customer count
      $scope.filteredItemCount = function()
      {
        if ($scope.customers == null) return 0;
        var results = $scope.customers;
        if ($scope.customerSearchText != "") results = _.filter(results, function(e){ return e.Customer.name.toLocaleLowerCase().indexOf($scope.customerSearchText.toLocaleLowerCase()) > -1; });
        return results.length - $scope.getOption('item_limit');
      };

      // Show more data
      $scope.showMore = function()
      {
        $scope.setOption('item_limit', $scope.getOption('item_limit') + $scope.getOption('default_item_limit'));
      };

      // Open modal
      $scope.open = function()
      {
        $scope._bootstrap(function(){
          $scope.modalElement.modal('show');
        });
      };

      // Close modal
      $scope.close = function()
      {
        $scope.modalElement.modal('hide');
      };

      // Select value
      $scope.selectCustomer = function(customer)
      {
        $scope.btCustomer = customer.Customer;
        $scope.setOption('internal_lock', false);
        $scope.close();
      };

      // Add new
      $scope.addNew = function(customer_name)
      {
        if (!customer_name || $scope.isLoading('save')) return;
        $scope.setOption('internal_lock', true);
        $scope.loading('save');
        CaseRecordSystemService.save_customer({Customer: {name: customer_name}}, function(result){
          $scope.setOption('internal_lock', false);
          $scope.loaded('save');
          if (result.success == "ok")
          {
            $scope.$parent.$parent.$broadcast('added-customer', result.data);
            $scope.selectCustomer(result.data);
            return;
          }
          BootstrapDialog.show({
            type: BootstrapDialog.TYPE_DANGER,
            title: 'Hata oluştu',
            message: result.message
          });
        });
      };

      // Listen customer added event
      $scope.$on('added-customer', function(event, customer){
        //if (_.find($scope.customers, function(_customer){ return _customer.name == customer.name; }) != undefined) return;
        $scope.customers.push(customer);
      });

    }],
    link: function($scope, element, attr) {
      var modal = element.find('.modal').modal({show: false});
      modal.on('hide.bs.modal', function(event){
        if ($scope.isLocked()) return event.preventDefault();
      });
      modal.appendTo("body");

      $scope.modalElement = modal;
    }
  };
});
