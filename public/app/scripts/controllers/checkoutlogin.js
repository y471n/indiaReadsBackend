'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:CheckoutloginCtrl
 * @description
 * # CheckoutloginCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('CheckoutloginCtrl', function ($scope, $state, SignupService, $auth, Loading, $rootScope, toaster, $window) {

    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
    $scope.guest = false;

  	$scope.continueOrder = function() {
      if($scope.isAuthenticated()) {
          $state.go('checkout.delivery');
      }
      if(!$scope.guest && $scope.userEmail && $scope.userPassword && !$scope.isAuthenticated()) {
        // Login the user;
        $scope.login();
        return;
      }
      if($scope.guest && $scope.userEmail) {
          // Signup the user

          $scope.signup();
      } else {
          // Please, enter a valid email idiot
          toaster.pop('error', "Error", "Please, enter a valid email address and password");
      }


  	};

    $scope.isAuthenticated = function() {
        return $auth.isAuthenticated();
    };


  $scope.signup = function() {
    // console.log($scope.new_signup_email);
    SignupService.signup($scope.userEmail).then(function(response) {

      if(response["token"]) {
        $auth.setToken(response.token);
          $rootScope.authenticated = true;

          $rootScope.user_email = response.email;
          localStorage.setItem('user_email', response.email);
          localStorage.setItem('user_id', response.user_id);

          $state.go('checkout.delivery', {});
      }
    });
  };

  $scope.login = function() {
    console.log('logging in');
    $auth.login({
      email: $scope.userEmail,
      password: $scope.userPassword
    })
    .then(function(response) {
        // Redirect user here after a successful log in.
        // $auth.setToken("logged_");
        localStorage.setItem('auth_token', response["data"].token);

        $rootScope.authenticated = true;

        $rootScope.user_email = response["data"].email;
        localStorage.setItem('user_email', response["data"].email);
        localStorage.setItem('user_id', response["data"].user_id);
        localStorage.setItem('satellizer_token', "logged_in");

        if(response["data"].company_name) {
          $window.location.href="http://"+response["data"].company_name+".ireads.com:8000";
          return;
        }

        $state.go('checkout.delivery', {});
      })
      .catch(function(response) {
        // Handle errors here, such as displaying a notification
        // for invalid email and/or password.
        console.log("error"+response);
      });
  };

  $scope.googleLogin = function() {

    $auth.authenticate('google').then(function(response) {

      $auth.setToken(response["data"].token);
        $rootScope.authenticated = true;

        $rootScope.user_email = response["data"].email;
        localStorage.setItem('auth_token', response["data"].token);
        localStorage.setItem('user_email', response["data"].email);
        localStorage.setItem('satellizer_token', "logged_in");
        localStorage.setItem('user_id', response["data"].user_id);

        $state.go('checkout.delivery', {});
    })
    .catch(function(response){
      console.log('red'+response);
    });

  };

  $scope.facebookLogin = function() {

    $auth.authenticate('facebook').then(function(response) {
      console.log('rd'+response);
      $auth.setToken(response["data"].token);
        $rootScope.authenticated = true;

        $rootScope.user_email = response["data"].email;
        localStorage.setItem('user_email', response["data"].email);
        localStorage.setItem('auth_token', response["data"].token);
        localStorage.setItem('satellizer_token', "logged_in");
        localStorage.setItem('user_id', response["data"].user_id);

        $state.go('checkout.delivery', {});
    })
    .catch(function(response){
      console.log('red'+response);
    });

  };


  });
