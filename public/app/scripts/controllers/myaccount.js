'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:AccountCtrl
 * @description
 * # AccountCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('AccountCtrl', function ($scope, Loading, $rootScope) {
    this.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
  });
