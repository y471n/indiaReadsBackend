'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:LoginCtrl
 * @description
 * # LoginCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('LoginCtrl', function ($scope, $auth, LoginService, $state, $rootScope, $window, Loading, SignupService, toaster) {
	$scope.userEmail = "";
	$scope.userPassword = "";

	$scope.in_loading = false;
  $auth.setStorageType('localStorage');

	Loading.setLoading(false);
    $rootScope.$broadcast("loading");

    $scope.isAuthenticated = function() {
  		return $auth.isAuthenticated();
	};

	if($scope.isAuthenticated()) {
		$state.go('homepage');
	}

	$scope.signup = function() {
		$scope.in_loading = true;
		// console.log($scope.new_signup_email);
		SignupService.signup($scope.new_signup_email).then(function(response) {

			$scope.in_loading = false;

			if(response["token"]) {

				toaster.pop('success', "Logged In", "Check your email for verification");

				$auth.setToken(response.token);
		    	$rootScope.authenticated = true;

		    	$rootScope.user_email = response.email;
		    	localStorage.setItem('user_email', response.email);
		    	localStorage.setItem('user_id', response.user_id);

		    	$state.go('homepage', {});
			} else {
				toaster.pop('error', "Already Registered User", "Use forgot password to set new password");
			}
		});
	};
	$scope.login = function() {
		$scope.in_loading = false;

		$auth.login({
		  email: $scope.userEmail,
		  password: $scope.userPassword
		});
console.log('iiiii');
		LoginService.login($scope.userEmail,$scope.userPassword).then(function(response) {
console.log('kkkk');
			
			if(response["token"]){
				console.log(response);
				console.log('suc');
				$scope.in_loading = false;

				toaster.pop('success', "Successfully Logged In");

				console.log($scope.userEmail);
				console.log($scope.userPassword);

				$auth.setToken(response["token"]);
			    // Redirect user here after a successful log in.
	        	//console.log(response);
			    // $auth.setToken(response["data"].token);
			    $rootScope.authenticated = true;
	        	//console.log('token'+response["data"].token);
			    $rootScope.user_email = response["email"];
			    localStorage.setItem('user_email', response["email"]);
			    localStorage.setItem('user_id', response["user_id"]);
	        	// localStorage.setItem('satellizer_token', String(response["data"].token));
	        	var v = String(response["token"]);
	        	localStorage.setItem('auth_token', response["token"]);
	        	localStorage.setItem('satellizer_token', "logged_in");
	        	// $authProvider.tokenPrefix = 'test';

			    if(response["company_name"]) {
			    	$window.location.href="http://"+response["company_name"]+".ireads.com:8000";
			    	return;
			    }

			    $state.go('homepage', {});
			}else{
				toaster.pop('error',"Invalid credentials");
				$state.go('login',{});
				$scope.in_loading = false;
			}
			  })
		  .catch(function(response) {
		    // Handle errors here, such as displaying a notification
		    // for invalid email and/or password.
		    console.log("error"+ response.object);
		    console.log("log");
		    $state.go('login',{});
	    });
	};

	$scope.googleLogin = function() {
		// $scope.in_loading = true;

		$auth.authenticate('google').then(function(response) {

			$scope.in_loading = false;

			toaster.pop('success', "Successfully Logged In");
      		localStorage.setItem('auth_token', response["data"].token);
			// $auth.setToken(response["data"].token);
      		localStorage.setItem('satellizer_token', "logged_in");
		    $rootScope.authenticated = true;

		    $rootScope.user_email = response["data"].email;
		    localStorage.setItem('user_email', response["data"].email);
		    localStorage.setItem('user_id', response["data"].user_id);

		    $state.go('homepage', {});
		})
		.catch(function(response){
			console.log('red'+response);
			$scope.in_loading = false;
		});

	};

	$scope.facebookLogin = function() {
		// $scope.in_loading = true;

		$auth.authenticate('facebook').then(function(response) {

			$scope.in_loading = false;

			toaster.pop('success', "Successfully Logged In");

			console.log('rd'+response);
      localStorage.setItem('auth_token', response["data"].token);
      localStorage.setItem('satellizer_token', "logged_in");
			// $auth.setToken(response["data"].token);
		    $rootScope.authenticated = true;

		    $rootScope.user_email = response["data"].email;
		    localStorage.setItem('user_email', response["data"].email);
		    localStorage.setItem('user_id', response["data"].user_id);

		    $state.go('homepage', {});
		})
		.catch(function(response){
			console.log('red'+response);
			$scope.in_loading = false;
		});

	};


  });
