'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:AccountMyprofileCtrl
 * @description
 * # AccountMyprofileCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('AccountMyprofileCtrl', function ($scope, $state, Loading, $rootScope, MyProfileService, EditMyProfileService, toaster) {
  	
    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
    $scope.in_loading=true;

    $scope.myProfileService = MyProfileService;
    $scope.editMyProfileService = EditMyProfileService;
    $scope.profile_data = {};


    $scope.myProfileService.loadProfile().then(function(response) {
    	if(response["data"]) {
    		$scope.profile_data.alternateEmail = response["data"][0]["alternateEmail"];
    		$scope.profile_data.birthdate = new Date(response["data"][0]["birthdate"]);
    		$scope.profile_data.firstName = response["data"][0]["firstName"];
    		$scope.profile_data.gender = response["data"][0]["gender"];
    		$scope.profile_data.landline = response["data"][0]["landline"];
    		$scope.profile_data.lastName = response["data"][0]["lastName"];
    		$scope.profile_data.mobile = response["data"][0]["mobile"];
    		$scope.profile_data.userID = response["data"][0]["userID"];	
            $scope.in_loading=false;
    	}

    });

    $scope.updateProfile = function() {
    	$scope.editMyProfileService.updateProfile($scope.profile_data).then(function(response) {
            if(response["response"] == "success") {
                toaster.pop('success', "Profile Updated!");
            }
    	});
    };

});