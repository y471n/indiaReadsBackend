'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:AccountAddressbookCtrl
 * @description
 * # AccountAddressbookCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('AccountAddressbookCtrl', 
  	function ($scope, $state, $auth, DeliveryAddressService, Loading, $rootScope) {
	
	$scope.showAddress = false;
	$scope.in_loading = true;
	$scope.deliveryAddressService = DeliveryAddressService;
	Loading.setLoading(false);
    $rootScope.$broadcast("loading");
    $scope.deliveryAddressService.loadDeliveryAddresses().then(function() {
  		$scope.in_loading=false;
    });

    $scope.isAuthenticated = function() {
	  	return $auth.isAuthenticated();
	};

	$scope.addAddressForm = function() {
		$scope.showAddress = true;
	};

	$scope.showAddressForm = function() {
		if(!$scope.isAuthenticated() || $scope.showAddress) {
			return true;
		}
		return false;
	};
    
	if($scope.isAuthenticated()	) {
		// Fetch user addresses if logged in;

	} 

  });
