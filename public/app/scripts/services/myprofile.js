'use strict';

/**
 * @ngdoc service
 * @name publicApp.homepage
 * @description
 * # homepage
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('MyProfileService', function (MyProfileFactory, $q) {
    // AngularJS will instantiate a singleton by calling "new" on this function
    var self = {
      'loadProfile': function() {
          var b=$q.defer();
    		  MyProfileFactory.query({auth_token: localStorage.getItem('auth_token')}, function(data) {
              console.log('first');
              console.log(data);
              console.log('second');
              b.resolve(data);
            }, function(error) {
              console.log("error");
            });
          return b.promise;
    	}
    };

    // self.loadTrendingBooks();
   // self.loadRecommendedBooks();
    // self.loadNewBooks();
    return self;
  });
