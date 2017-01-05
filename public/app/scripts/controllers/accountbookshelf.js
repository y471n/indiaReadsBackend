'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:AccountBookshelfCtrl
 * @description
 * # AccountBookshelfCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('AccountBookshelfCtrl', function ($scope, $state, Loading, $rootScope) {
  	console.log('hee');
  	$state.go('account.bookshelf.available');
  	Loading.setLoading(false);
    $rootScope.$broadcast("loading");
});