'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:RentalCtrl
 * @description
 * # RentalCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('RentalCtrl', function (Cart, $scope, $state, Loading, $rootScope) {
  
    Loading.setLoading(false);
    $rootScope.$broadcast("loading");

  	$scope.books = Cart.getProducts();
  	console.log($scope.books);

  	$scope.numberOfItems = Cart.getSize();

  	$scope.removeFromCart = function(book) {

  		// Check if book exists;
  		// Remove from Cart
  		Cart.removeProduct(book.book_id);
      $rootScope.$broadcast("change_cart_size");
      $scope.books = Cart.getProducts();
      $scope.numberOfItems = Cart.getSize();
      $scope.totalPrice = Cart.totalInitialPayable();
      $scope.totalAmount = $scope.finalAmount();
  		// If Cart empty; ???
  		// $state.go('homepage');
  	};

  	$scope.totalPrice = Cart.totalInitialPayable();

  	$scope.finalAmount = function() {

  		if(parseInt($scope.totalPrice) >= 350) {
  			return parseInt($scope.totalPrice);
  		}

  		return parseInt($scope.totalPrice) + 50;
  	};

    $scope.totalAmount = $scope.finalAmount();

  });