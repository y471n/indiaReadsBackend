'use strict';

/**
 * @ngdoc service
 * @name publicApp.homepage
 * @description
 * # homepage
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('BookshelfService', function (Available, Current, HistoryFactory, Wishlist, $q) {
    // AngularJS will instantiate a singleton by calling "new" on this function
    var self = {
      'available': [],
      'currently': [],
      'historybooks':[],
      'wishlist': [],

      'loadAvailableBooks': function(token) {
            self.available = [];
        	  self.loading = true;
            var b=$q.defer();
    		    Available.query({'token':token, auth_token: localStorage.getItem('auth_token')},function(data) {
              console.log('available'+data);
              self.isLoading = false;
              angular.forEach(data["data"], function(book) {

                self.available.push(new Available(book));
              });
            }, function(error) {
              console.log("error");
            });
            return b.promise;
    	},
      'loadCurrentlyBooks': function(token) {
            self.currently = [];
        	  self.loading = true;
            var b=$q.defer();
    		    Current.query({'token':token, auth_token: localStorage.getItem('auth_token')},function(data) {
              console.log(data);
              self.isLoading = false;
              angular.forEach(data["data"], function(book) {
                self.currently.push(new Current(book));
              });
            }, function(error) {
              console.log("error");
            });
            return b.promise;
    	},
    	'loadHistoryBooks': function(token) {
            self.historybooks = [];
        	  self.loading = true;
            var b=$q.defer();
    		    HistoryFactory.query({'token':token, auth_token: localStorage.getItem('auth_token')},function(data) {
              console.log(data);
              self.isLoading = false;
              angular.forEach(data["data"], function(book) {
                self.historybooks.push(new HistoryFactory(book));
              });
            }, function(error) {
              console.log("error");
            });
            return b.promise;
    	},
    	'loadWishlistBooks': function(token) {
            self.wishlist = [];
        	  self.loading = true;
            var b=$q.defer();
    		    Wishlist.query({'token':token, auth_token: localStorage.getItem('auth_token')},function(data) {
              console.log(data);
              self.isLoading = false;
              angular.forEach(data["data"], function(book) {
                self.wishlist.push(new Wishlist(book));
              });
            }, function(error) {
              console.log("error");
            });
            return b.promise;
    	}
    };
    return self;
  });
