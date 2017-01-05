'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:CheckoutCtrl
 * @description
 * # CheckoutCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('CheckoutCtrl', function ($state, $auth, $scope, Loading, $rootScope) {
    
 //    $scope.isAuthenticated = function() {
 //  		console.log($auth.isAuthenticated());
	//   	return $auth.isAuthenticated();
	// };
	Loading.setLoading(false);
    $rootScope.$broadcast("loading");

  });