'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:SetpasswordCtrl
 * @description
 * # SetpasswordCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('SetpasswordCtrl', function ($routeParams, $stateParams, $scope, $location, SetNewPassword, $state, Loading, $rootScope, toaster) {

    $scope.password = '';

    Loading.setLoading(false);
    $rootScope.$broadcast("loading");

    $scope.email = $stateParams.email;
    $scope.h = $stateParams.h;

    $scope.setpasswordService = SetNewPassword;
    console.log($scope.email);
    console.log("hiiii");
    $scope.setPassword = function() {
        $scope.setpasswordService.setPass($scope.email, 
             $scope.h, $scope.password).then(function() {
                          console.log("Test");
                // show some success toast                
                toaster.pop('success', "Password Set Successfully.");
                // goto login
                $state.go('login');

             }, function(error) {
                toaster.pop('error', "This link may have expired");
                console.log(error);
             });
    };


  });
