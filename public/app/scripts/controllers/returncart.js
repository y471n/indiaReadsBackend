'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ReturnCartCtrl
 * @description
 * # ForgotCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('ReturnCartCtrl', function ($scope, Loading, $rootScope) {
    this.awesomeThings = [
      'HTML5 Boilerplate',	
      'AngularJS',
      'Karma'
    ];

    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
  });