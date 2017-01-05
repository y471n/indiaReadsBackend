'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:BookshelfHistoryCtrl
 * @description
 * # BookshelfHistoryCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('BookshelfHistoryCtrl', function ($scope, $state, BookshelfService, Loading, $rootScope) {
  	
  	$scope.bookshelfService = BookshelfService;
  	$scope.bookshelfService.loadHistoryBooks().then(function() {
      $scope.in_loading=false;
    });
  	Loading.setLoading(false);
    $rootScope.$broadcast("loading");
    
});