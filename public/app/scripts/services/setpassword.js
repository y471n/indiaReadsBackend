'use strict';

/**
 * @ngdoc service
 * @name publicApp.setpassword
 * @description
 * # setpassowrd
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('SetNewPassword', function (SetNewPasswordFactory, $q) {
    // AngularJS will instantiate a singleton by calling "new" on this function

    var self = {
      'setPass': function(email_address, hash, pass) {
        	  var d = $q.defer();
  			  SetNewPasswordFactory.query({h: hash, email: email_address, new_pass: pass , auth_token: localStorage.getItem('auth_token')}, 
  			  	function(data) {
	  	          console.log(data);
	  	          // Password reset successful
	  	          d.resolve();
  	          
              }, function(error) {
              	  d.reject();
                  // console.log("error");
            });

  			return d.promise;
      },
    };

    return self;

  });
