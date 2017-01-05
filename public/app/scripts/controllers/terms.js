'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ToSCtrl
 * @description
 * # ToSCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('ToSCtrl', function ( Loading, $rootScope) {
    this.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
  });