'use strict';

/**
 * @ngdoc service
 * @name publicApp.product
 * @description
 * # product
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('ProductService', function (ProductFactory, $q) {
    
    var self = {
      'book': {},
      'getBook': function(book_isbn) {
        	  var d = $q.defer();
  			  
  			  ProductFactory.query({isbn: book_isbn}, 
  			  	function(data) {
	  	          console.log(data);
	  	          self.book = data["data"];
	  	          // Password reset successful
	  	          d.resolve(data["data"]);
  	          
              }, function(error) {
              	  d.reject();
                  // console.log("error");
            });

  			return d.promise;
      },
    };

    return self;

  });
