'use strict';

/**
 * @ngdoc service
 * @name publicApp.homepage
 * @description
 * # homepage
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('HomepageService', function (NewBook, TrendingBook, RecommendedBook, $q) {
    // AngularJS will instantiate a singleton by calling "new" on this function
    var self = {
      'newbooks': [],
      'trendingbooks': [],
      'recommendedbooks':[],
      'tagged': [],
      'page': 1,
      'hasMore': true,
      'isLoading': false,
      'loadNewBooks': function() {
          self.newbooks = [];
        	self.loading = true;
          var b=$q.defer();
    		  NewBook.query({}, function(data) {
              console.log(data);
              self.isLoading = false;
              angular.forEach(data["data"], function(book) {
                self.newbooks.push(new NewBook(book));
              });
              b.resolve();
            }, function(error) {
              console.log("error");
            });
          return b.promise;
    	},
      'loadTrendingBooks': function() {
          self.trendingbooks = [];
          self.loading = true;
          var d = $q.defer();
          TrendingBook.query({}, function(data) {

              console.log(data);
              self.isLoading = false;
              angular.forEach(data["data"], function(book) {
                self.trendingbooks.push(new TrendingBook(book));
              });
              d.resolve();
              
            }, function(error) {
              console.log("error");
            });
          return d.promise;
      },
      'loadRecommendedBooks': function() {
          self.recommendedbooks = [];
          self.loading = true;
          var c=$q.defer();
          RecommendedBook.query({}, function(data) {
              console.log(data);
              self.isLoading = false;
              angular.forEach(data["data"], function(book) {
                self.recommendedbooks.push(new RecommendedBook(book));
              });
              c.resolve();
            }, function(error) {
              console.log("error");
            });
          return c.promise;
      },
      'loadFiltered' : function() {
      	}
    };
    
    // self.loadTrendingBooks();
   // self.loadRecommendedBooks();
    // self.loadNewBooks();
    return self;
  });
