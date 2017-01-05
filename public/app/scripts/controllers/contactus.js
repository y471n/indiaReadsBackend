'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ContactusCtrl
 * @description
 * # ContactusCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('ContactusCtrl', function ($scope, Loading, $rootScope) {
    this.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];

    Loading.setLoading(false);
    $rootScope.$broadcast("loading");
  });