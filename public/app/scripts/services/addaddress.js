'use strict';

/**
 * @ngdoc service
 * @name publicApp.setpassword
 * @description
 * # setpassowrd
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('AddAddressService', function (AddAddressFactory, $q) {
    // AngularJS will instantiate a singleton by calling "new" on this function

    var self = {
      'addAddress': function(address_json) {
        	  var d = $q.defer();
  			    AddAddressFactory.query({address_json, auth_token: localStorage.getItem('auth_token')},
  			  	function(data) {
	  	          console.log(data);
	  	          d.resolve(data);
              }, function(error) {
              	  d.reject();
                  // console.log("error");
            });

  			return d.promise;
      },
    };

    return self;

  });
