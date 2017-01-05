'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:HowitworksCtrl
 * @description
 * # HowitworksCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('HowitworksCtrl', function ($scope, Loading, $rootScope) {
    this.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
  });