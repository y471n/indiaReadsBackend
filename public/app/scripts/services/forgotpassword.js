  'use strict';

/**
 * @ngdoc service
 * @name publicApp.setpassword
 * @description
 * # setpassowrd
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('ForgotPasswordService', function (ForgotPasswordFactory, $q) {
    // AngularJS will instantiate a singleton by calling "new" on this function

    var self = {
      'getPasswordLink': function(email_address) {
        	  var d = $q.defer();
  			    ForgotPasswordFactory.query({email: email_address , auth_token: localStorage.getItem('auth_token')},
  			  	function(data) {
	  	          console.log(data);
                console.log('t'+data);
	  	          // Password signup
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
