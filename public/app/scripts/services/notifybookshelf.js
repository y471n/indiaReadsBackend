'use strict';

/**
 * @ngdoc service
 * @name publicApp.setpassword
 * @description
 * # setpassowrd
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('NotifyBookshelfService', function (NotifyBookshelfFactory, $q) {
    // AngularJS will instantiate a singleton by calling "new" on this function

    var self = {
      
      'notify': function(book_details, email_address) {
        	  var d = $q.defer();
            // console.log(params);
  			    NotifyBookshelfFactory.query({books: book_details, email: email_address, auth_token: localStorage.getItem('auth_token')},
             function(data) {

                console.log('t'+data);
	  	          d.resolve(data);
  	          
              }, function(error) {
              	  d.reject();
                  // console.log("error");
            });

      			return d.promise;
      }

    };

    return self;

  });
