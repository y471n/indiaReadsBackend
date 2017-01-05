'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:CheckoutdeliveryaddressCtrl
 * @description
 * # CheckoutdeliveryaddressCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('CheckoutdeliveryaddressCtrl', function ($scope, $state, $auth, DeliveryAddressService, AddAddressService, Loading, $rootScope) {
    
    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
    $scope.in_loading= true;
  	$scope.showAddress = false;
  	$scope.addAddressService = AddAddressService;
  	$scope.address = {};
  	$scope.address.fullname = '';
  	$scope.address.address_line1 = '';
  	$scope.address.address_line2 = '';
  	$scope.address.city = '';
  	$scope.address.state = '';
  	$scope.address.pincode = '';
  	$scope.address.phone = '';

  	DeliveryAddressService.loadDeliveryAddresses().then(function() {
  		$scope.in_loading=false;
    });

    if(!localStorage.getItem('user_email')) {
    	// goto login
    	$state.go('checkout.login');
    }

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
    
	if($scope.isAuthenticated) {
		// Fetch user addresses if logged in;

	} 

	$scope.deliveryAddressService = DeliveryAddressService;

	$scope.selectAddress = function(deliveryAddress, addressBookId) {
		// console.log('addressbook id :' + addressBookId);
		localStorage.setItem('delivery_address', JSON.stringify(deliveryAddress));
		localStorage.setItem('delivery_address_id', addressBookId);
		$state.go('checkout.payment');
	};

	$scope.addAddress = function() {

		var address_json = {
			'fullname' : $scope.address.fullname,
			'address_line1': $scope.address.addressline1,
			'address_line2': $scope.address.addressline2, 
			'city' : $scope.address.city,
			'state': $scope.address.state,
			'pincode': $scope.address.pincode,
			'phone': $scope.address.phone
		}
		$scope.addAddressService.addAddress(address_json).then(function() {
				console.log('came back here');
		});
		localStorage.setItem('checkout_address', JSON.stringify(this.address));
		$state.go('checkout.payment');
	};
  });
