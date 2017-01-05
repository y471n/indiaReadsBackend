'use strict';

/**
 * @ngdoc service
 * @name publicApp.catlist
 * @description
 * # catlist
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('SearchService', function (SearchFactory, $q) {
    // AngularJS will instantiate a singleton by calling "new" on this function

    var self = {
      'books': [],
      
      'searchBooks': function(query) {
        console.log('calling searchbooks');
        var b=$q.defer();
      	SearchFactory.query({query: query}, function(data) {
	  console.log(data);

	  angular.forEach(data["data"]["ISBN13"]["groups"], function(book) {
	    self.books.push(new SearchFactory(book["doclist"]["docs"][0]));
	    console.log(book["doclist"]["docs"][0]);
	  });

	  b.resolve();

	  self.isLoading = false;
	  }, function(error) {
	    console.log("error");
       });
          return b.promise;
      }

    };
    return self;
  });
