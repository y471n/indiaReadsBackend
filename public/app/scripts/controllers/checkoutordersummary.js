'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:CheckoutordersummaryCtrl
 * @description
 * # CheckoutordersummaryCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('CheckoutordersummaryCtrl', function (Cart, $scope, Loading, $rootScope, StoreCreditsService, CheckoutService) {

  	Loading.setLoading(false);
    $rootScope.$broadcast("loading");

    $scope.in_loading = true;
    $scope.store_credits = 0;

    $scope.storeCreditsService = StoreCreditsService;

    $scope.books = Cart.getProducts();

    $scope.totalPrice = Cart.totalInitialPayable();
    $scope.finalAmount = 0;

    $scope.shippingCharges = function() {
  		if(parseInt($scope.totalPrice) >= 350) {
  			return 0;
  		}
  		return 50;
  	};

  	$scope.codCharges = function() {
  		if(localStorage.getItem('checkout_method') == "cod") {
  			return 10;
  		}
  		return 0;
  	};

  	// $scope.totalPayable = function() {
  	// 	return $scope.totalPrice + $scope.shippingCharges() + $scope.codCharges() - $scope.store_credits;
  	// };

    $scope.paymentMode = function() {
  		if(localStorage.getItem('checkout_method') == "cod") {
  			return "cod";
  		}
  		return "online";
  	};

  	$scope.paymentModeText = function() {
		if(localStorage.getItem('checkout_method') == "cod") {
			return "Cash on Delivery";
		}
		return "Online Payment";
  	};

  	$scope.makePaymentText = function() {
  		if(localStorage.getItem('checkout_method') == "cod") {
			return "Place Order";
		}
		return "Make Payment";
  	};

  	if(localStorage.getItem('delivery_address')) {
    	$scope.deliveryAddress = JSON.parse(localStorage.getItem('delivery_address'));
    	console.log($scope.deliveryAddress);
    }

    $scope.placeOrder = function() {
      console.log($scope.paymentMode());
    	$scope.cart = JSON.parse(localStorage.getItem('cart'));
        $scope.user_email = localStorage.getItem('user_email');
        $scope.user_address = JSON.parse(localStorage.getItem('checkout_address'));
        var user_id = localStorage.getItem('user_id');
        var address_id = localStorage.getItem('delivery_address_id');
        var parent_order_id = localStorage.getItem('parent_order_id');

        // $scope.post_data = {'uid': user_id, 'address_id': address_id, 'book_details': $scope.cart};

    	if($scope.paymentMode() == "cod") {
    		// cod payment
    		CheckoutService.postCod(user_id, address_id, parent_order_id, $scope.cart, $scope.shippingCharges(),
                $scope.codCharges(), $scope.store_credits, $scope.totalPrice).then(function(data) {
    			   // Parse Data; Move to next page
             console.log('cod+'+data);
    		});
    	} else if($scope.paymentMode() == "online" || $scope.paymentMode() == "paytm") {
          	CheckoutService.postPaytm($scope.post_data);
      }
    };

    $scope.storeCreditsService.getCredits().then(function(data) {
        $scope.in_loading = false;
        $scope.store_credits = data["data"][0]["store_credit"];
        console.log('data'+data);

        $scope.finalAmount =  $scope.totalPrice + $scope.shippingCharges() + $scope.codCharges() - $scope.store_credits;
    });

  });
