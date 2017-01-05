'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ThankCtrl
 * @description
 * # ThankCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('ThankCtrl', function ($scope, Loading, $rootScope) {
    this.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
  });