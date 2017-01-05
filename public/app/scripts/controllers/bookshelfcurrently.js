'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:BookshelfCurrentlyCtrl
 * @description
 * # BookshelfCurrentlyCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('BookshelfCurrentlyCtrl', function ($scope, $state, BookshelfService, Loading, $rootScope) {

  	$scope.in_loading= true;
  	$scope.bookshelfService = BookshelfService;
  	$scope.bookshelfService.loadCurrentlyBooks().then(function() {
      $scope.in_loading=false;
    });
  	Loading.setLoading(false);
    $rootScope.$broadcast("loading");  
});