'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:AboutUsCtrl
 * @description
 * # AboutUsCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('AboutUsCtrl', function ( Loading, $rootScope) {
    this.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
  });
