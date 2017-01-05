'use strict';

/**
 * @ngdoc service
 * @name publicApp.homepage
 * @description
 * # homepage
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('MyOrdersService', function (MyOrdersFactory, $q) {
    // AngularJS will instantiate a singleton by calling "new" on this function
    var self = {
      'details':[],
      'parentorderid': 1,
      'loadOrders': function() {
          var b=$q.defer();
    		  MyOrdersFactory.query({auth_token: localStorage.getItem('auth_token')}, function(data) {
              console.log(data);              
              angular.forEach(data["data"], function(orders) {
                self.details.push(new MyOrdersFactory(orders));              
                if(orders.details) {
                  console.log(orders.details[0]["init_pay"]);  
                }
                
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
