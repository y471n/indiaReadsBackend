'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:BookshelfAvailableCtrl
 * @description
 * # BookshelfAvailableCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('BookshelfAvailableCtrl', function ($scope, $state, BookshelfService, Loading, $rootScope) {
  	

  	$scope.in_loading = false;
  	$scope.bookshelfService = BookshelfService;
    $scope.bookshelfService.loadAvailableBooks();

    Loading.setLoading(false);
    $rootScope.$broadcast("loading");

});