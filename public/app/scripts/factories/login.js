'use strict';

/**
 * @ngdoc service
 * @name publicApp.catlistFactory
 * @description
 * # catlistFactory
 * Service in the publicApp.
 */
angular.module('publicApp')
  .factory('LoginFactory', function($resource) {
    return $resource(
    	'/api/login',
    	null,
    	{'query': { method: 'POST' }} );    
  });
