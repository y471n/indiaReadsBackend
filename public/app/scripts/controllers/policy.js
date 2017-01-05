'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:PolicyCtrl
 * @description
 * # PolicyCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('PolicyCtrl', function ( Loading, $rootScope) {
    this.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
  });