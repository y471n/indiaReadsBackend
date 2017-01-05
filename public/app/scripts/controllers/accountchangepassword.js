'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:AccountChangePasswordCtrl
 * @description
 * # AccountChangePasswordCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('SetPasswordCtrl', function ($scope, $state, Loading, $rootScope) {
  	$scope.password = '';

    Loading.setLoading(false);
    $rootScope.$broadcast("loading");

    $scope.email = $stateParams.email;
    $scope.h = $stateParams.h;

    $scope.setpasswordService = SetNewPassword;
    

    $scope.setPassword = function() {

        alert($scope.h+$scope.email);
        $scope.setpasswordService.setPass($scope.email, 
             $scope.h, $scope.password).then(function() {
                
                // show some success toast                
                alert('Password set Successfully');
                // goto login
                $state.go('login');

             }, function(error) {
                console.log(error);
             });
    };
});