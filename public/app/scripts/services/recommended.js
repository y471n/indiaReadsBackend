'use strict';

/**
 * @ngdoc service
 * @name publicApp.catlist
 * @description
 * # catlist
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('RecommendedService', function (RecommendedBooks, $q) {
    // AngularJS will instantiate a singleton by calling "new" on this function

    var self = {
      'books': [],    
      'page': 1,
      'hasMore': true,
      'isLoading': false,

      'loadBooks': function() {
          self.books = [];
          self.loading = true;
          var b=$q.defer();
          RecommendedBooks.query({}, function(data) {
              console.log(data);
              self.isLoading = false;
              angular.forEach(data["data"], function(book) {
                self.books.push(new RecommendedBooks(book));
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
