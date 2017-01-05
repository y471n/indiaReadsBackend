'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:BookshelfWishlistCtrl
 * @description
 * # BookshelfWishlistCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('BookshelfWishlistCtrl', function ($scope, $state, BookshelfService, Loading, $rootScope) {
  	
  	$scope.bookshelfService = BookshelfService;
  	$scope.bookshelfService.loadWishlistBooks();
  	Loading.setLoading(false);
    $rootScope.$broadcast("loading");
});