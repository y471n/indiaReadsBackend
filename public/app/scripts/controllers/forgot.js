'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ForgotCtrl
 * @description
 * # ForgotCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('ForgotCtrl', function ($scope, Loading, $rootScope, ForgotPasswordService) {

    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
    // $scope.user_email = "";
    $scope.response_message_success = false;
    $scope.response_message_no_user = false;

    $scope.forgotPassword = function() {
    	// console.log($scope.user_email);
		$scope.in_loading = true;
		ForgotPasswordService.getPasswordLink($scope.user_email).then(function(response) {

			if(response["response"] == "success") {
				$scope.response_message_success = true;
			}

			if(response["response"] == "no_user") {
				$scope.response_message_no_user = true;
			}

			$scope.in_loading = false;
			console.log(response);
			
		});
	};


  });