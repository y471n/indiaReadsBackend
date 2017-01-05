'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:HeaderCtrl
 * @description
 * # HeaderCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('HeaderCtrl', function ($rootScope, $scope, $auth, $state, Cart, Loading) {
    
    Loading.setLoading(false);
    $rootScope.$broadcast("loading");

    $scope.numberOfItems = Cart.getSize();
    
    
  $scope.user_email = $rootScope.user_email;
  if(!$scope.user_email) {
      $scope.user_email = localStorage.getItem('user_email');  
  }

  $rootScope.$on("change_cart_size", function() {
    console.log('changing cart size');
    $scope.numberOfItems = Cart.getSize();
    console.log(Cart.getSize());
  });

  $scope.search = function() {
  	console.log($scope.search_query);
 	$state.go('search', {query: $scope.search_query });
  }; 
 
  $rootScope.$on("loading", function() {
      $scope.loading = Loading.loading();
      $rootScope.loading = $scope.loading;
  });

  // $rootScope.$watch('loading', function(newValue, oldValue) {
  //     $scope.loading = newValue;
  // });

  $scope.isAuthenticated = function() {
  	return $auth.isAuthenticated();
	};

	$scope.logout = function() {
		$auth.logout().then(function() {

        localStorage.removeItem('user_email');
        localStorage.removeItem('user_id');

        $rootScope.authenticated = false;
        $state.go('homepage');
    });
	};

  });
