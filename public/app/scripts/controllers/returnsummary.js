'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ReturnCtrl
 * @description
 * # ReturnCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('ReturnCtrl', function ($scope, Loading, $rootScope) {
    this.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
  });
