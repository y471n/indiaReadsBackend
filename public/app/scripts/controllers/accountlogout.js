'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:AccountLogoutCtrl
 * @description
 * # AccountLogoutCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('AccountLogoutCtrl', function ($rootScope, $scope, $auth, $state, Loading) {

		$auth.logout().then(function() {

                localStorage.removeItem('user_email');
                localStorage.removeItem('user_id');

                $rootScope.authenticated = false;
                $state.go('homepage');
            });
		Loading.setLoading(false);
    $rootScope.$broadcast("loading");
});