'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # product
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('StoreCreditDetailsService', function (StoreCreditDetailsFactory, $q) {

    var self = {
      'details':[],
      'loadCredits': function() {
        	  var d = $q.defer();
  			  StoreCreditDetailsFactory.query({auth_token: localStorage.getItem('auth_token')}, 
  			  	function(data) {
	  	          console.log(data);
	  	          angular.forEach(data["data"], function(credit) {
                self.details.push(new StoreCreditDetailsFactory(credit));
              });
              d.resolve();
              }, function(error) {
              	  d.reject();
                  // console.log("error");
            });

  			return d.promise;
      }
    };

    return self;

  });