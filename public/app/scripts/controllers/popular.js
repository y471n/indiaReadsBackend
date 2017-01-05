'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:NewCtrl
 * @description
 * # HowitworksCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('PopularCtrl', function ($scope, $stateParams, Loading, $rootScope, PopularService) {
    
    $scope.loadedBooks = false;
    $scope.popularService = PopularService;
    $scope.in_loading=true;

    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
 
    $scope.popularService.loadBooks().then(function() {
      $scope.in_loading=false;
    $scope.loadedBooks = true;
    });
  });