'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:PickUpCtrlCtrl
 * @description
 * # PickupCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('PickUpCtrl', function ($scope, $state, $auth, DeliveryAddressService, Loading, $rootScope) {
$scope.showAddress = false;

	Loading.setLoading(false);
    $rootScope.$broadcast("loading");
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
    
	if($scope.isAuthenticated()) {
		// Fetch user addresses if logged in;

	} 

	$scope.deliveryAddressService = DeliveryAddressService;

  });
