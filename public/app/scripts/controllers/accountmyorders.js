'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:AccountMyordersCtrl
 * @description
 * # AccountMyordersCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('AccountMyOrdersCtrl', 
    function ($scope, $state, $auth, Loading, $rootScope, MyOrdersService) {

  	$scope.myOrdersService = MyOrdersService;
    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
    $scope.in_loading=true;
    $scope.isAuthenticated = function() {
        return $auth.isAuthenticated();
    };
    $scope.myOrdersService.loadOrders().then(function(response) {
    	$scope.in_loading=false;
    });
});