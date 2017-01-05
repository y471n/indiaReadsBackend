'use strict';

/**
 * @ngdoc service
 * @name publicApp.setpassword
 * @description
 * # setpassowrd
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('AddToBookshelfService', function (AddToBookshelfFactory, $q) {
    // AngularJS will instantiate a singleton by calling "new" on this function

    var self = {
      'addtobookshelf': function(book_details) {
        	  var d = $q.defer();
            var book_details = JSON.stringify(book_details);
            console.log(book_details);
  			    AddToBookshelfFactory.query({books: book_details , auth_token: localStorage.getItem('auth_token')},
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
