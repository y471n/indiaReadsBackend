'use strict';

/**
 * @ngdoc service
 * @name publicApp.homepage
 * @description
 * # homepage
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('DeliveryAddressService', function (DeliveryAddresses, $q) {
    
    // AngularJS will instantiate a singleton by calling "new" on this function

    var self = {
      'deliveryAddresses': [],
      'tagged': [],
      'page': 1,
      'hasMore': true,
      'isLoading': false,
      'loadDeliveryAddresses': function() {
        	self.loading = true;
          	var b=$q.defer();
    		  DeliveryAddresses.query({auth_token: localStorage.getItem('auth_token')}, function(data) {
              console.log(data);
              console.log("sdjk");
              self.isLoading = false;
              angular.forEach(data["data"], function(address) {
                self.deliveryAddresses.push(new DeliveryAddresses(address));
              });
              b.resolve();
            }, function(error) {
              console.log("error");
            });
          return b.promise;
    	}
    };
    return self;
  });
