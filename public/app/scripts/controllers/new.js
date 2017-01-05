'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:NewCtrl
 * @description
 * # HowitworksCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('NewCtrl', function ($scope, $stateParams, Loading, $rootScope, NewService) {
    
    $scope.loadedBooks = false;
    $scope.newService = NewService;
    $scope.in_loading=true;

    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
 
    $scope.newService.loadBooks().then(function() {
      $scope.in_loading=false;
    $scope.loadedBooks = true;
    });
  });