'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:CheckoutpaymentCtrl
 * @description
 * # CheckoutpaymentCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('CheckoutpaymentCtrl', function ($scope, CheckoutService, PayuMoneyService, $http, $rootScope, Cart, $state, Loading) {

    Loading.setLoading(false);
    $rootScope.$broadcast("loading");


    $scope.checkout_service = CheckoutService;

    $scope.in_loading = true;
    // $scope.payumoneyservice = PayuMoneyService;

    $scope.total_price = Cart.totalInitialPayable();

    $scope.paymentMode = "cod";

    $scope.cart = JSON.parse(localStorage.getItem('cart'));
    $scope.user_email = localStorage.getItem('user_email');
    $scope.user_address = JSON.parse(localStorage.getItem('checkout_address'));
    var user_id = localStorage.getItem('user_id');
    var address_id = localStorage.getItem('delivery_address_id');
    $scope.post_data = JSON.stringify({'uid': user_id, 'address_id': address_id, 'cart': $scope.cart,
          'total_price': $scope.total_price});

    $scope.checkout_service.preOrder($scope.post_data).then(function(data) {
        $scope.in_loading = false;
        localStorage.setItem('parent_order_id', data["parent_order_id"]);
    });


    //$scope.payumoneyservice.loadPayment().then(function(data) {
          // var key = data["key"];
          // var amount = data["amount"];
          // var email = data["email"];
          // var firstname = data["firstname"];
          // var furl = data["furl"];
          // var hash = data["hash"];
          // var phone = data["phone"];
          // var productinfo = data["productinfo"];
          // var service_provider = data["service_provider"];
          // var surl = data["surl"];
          // var txnid = data["txnid"];


         // var data = {
         //          redirectUrl: 'https://test.payu.in/_payment',
         //          redirectMethod: 'POST',
         //          redirectData: {
         //              'input1': 'value1',
         //              'input2': 'value2'
         //          }
         //      };

         //      $rootScope.$broadcast('gateway.redirect', data);

          // $http({
          //     method: 'GET',
          //     url: 'https://test.payu.in/_payment'
          //  }).then(function successCallback(response) {
          //       // this callback will be called asynchronously
          //       // when the response is available
          //  }, function errorCallback(response) {
          //       // called asynchronously if an error occurs
          //       // or server returns response with an error status.
          //  });
    // });

    $scope.proceed = function() {

        localStorage.setItem('checkout_method', $scope.paymentMode);
        $state.go('checkout.summary');

     //    $scope.cart = JSON.parse(localStorage.getItem('cart'));
     //    $scope.user_email = localStorage.getItem('user_email');
     //    $scope.user_address = JSON.parse(localStorage.getItem('checkout_address'));
     //    var user_id = localStorage.getItem('user_id');
     //    var address_id = localStorage.getItem('delivery_address_id');
     //    $scope.post_data = {'uid': user_id, 'address_id': address_id, 'book_details': $scope.cart};

    	// if($scope.paymentMode == "cod") {
    	// 	// cod payment

    	// 	$scope.checkout_service.postCod($scope.post_data).then(function() {
    	// 		   // Parse Data; Move to next page
    	// 	});
    	// } else if($scope.paymentMode == "paytm") {
     //      $scope.checkout_service.postPaytm($scope.post_data);
     //  }
   };

  });
