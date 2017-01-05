'use strict';

/**
 * @ngdoc service
 * @name publicApp.setpassword
 * @description
 * # setpassowrd
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('LoginService', function (LoginFactory, $q) {
    // AngularJS will instantiate a singleton by calling "new" on this function
    
    var self = {
      'login': function(email,password) {
         console.log(email);
         console.log('nnn');
        	  var d = $q.defer();
  			    LoginFactory.query({email:email,password:password,auth_token: localStorage.getItem('auth_token')},
  			  	function(data) {
                //console.log(email);
                console.log("hiii");
	  	          console.log(data);
                console.log('u'+ data);
	  	          // Password Login
	  	          d.resolve(data);
  	          
              }, function(error) {
              	  d.reject();
                  // console.log("rerror");
            });

  			return d.promise;
      },
    };

    return self;

  });
