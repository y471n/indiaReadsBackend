'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:NewCtrl
 * @description
 * # HowitworksCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('RecommendedCtrl', function ($scope, $stateParams, Loading, $rootScope, RecommendedService) {
    
    $scope.loadedBooks = false;
    $scope.recommendedService = RecommendedService;
    $scope.in_loading=true;

    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
 
    $scope.recommendedService.loadBooks().then(function() {
      $scope.in_loading=false;
    $scope.loadedBooks = true;
    });
  });